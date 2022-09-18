<?php


namespace App\Repositories;

use App\DbModels\Order;
use App\DbModels\Payment;
use App\Events\Order\OrderCreatedEvent;
use App\Events\Order\OrderUpdatedEvent;
use App\Repositories\Contracts\OrderDetailRepository;
use App\Repositories\Contracts\OrderLogRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\ProductOfferRepository;
use ArrayAccess;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentOrderRepository extends EloquentBaseRepository implements OrderRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        if (isset($searchCriteria['endDate'])) {
            $ $queryBuilder  =  $queryBuilder->whereDate('created_at', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder =  $queryBuilder->whereDate('created_at', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        $searchCriteria = $this->applyFilterInOrderSearch($searchCriteria);

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);

        if (empty($searchCriteria['withOutPagination'])) {
            return $queryBuilder->paginate($limit);
        } else {
            return $queryBuilder->get();
        }
    }

    /**
     * inherit doc
     */
    public function save(array $data): ArrayAccess
    {
        DB::beginTransaction();
        $loggedInUserId = $this->getLoggedInUser()->id;

        $data['createdByUserId'] = $loggedInUserId;
        $data['due'] = $data['amount'];
        $data['status'] = Order::STATUS_REQUEST;
        $data['paymentStatus'] = Payment::STATUS_UNPAID;

        $order = parent::save($data);

        $orderLog['orderId'] = $order->id;
        $orderLog['status'] = $order->status;
        $orderLog['comments'] = 'By Accepting T&C and Purchasing policy. ' . $order->invoice . ' has been '. $order->status.' by - Customer';

        $orderLogRepository = app(OrderLogRepository::class);
        $orderLogRepository->save($orderLog);

        event(new OrderCreatedEvent($order, $data['products'], $this->generateEventOptionsForModel()));

        DB::commit();
        return $order;
    }

    /**
     * inherit doc
     * @param ArrayAccess $model
     * @param array $data
     * @return ArrayAccess
     */
    public function update(ArrayAccess $model, array $data): ArrayAccess
    {
        DB::beginTransaction();

        $comments = '';
        if(isset($data['comments'])) {
            $comments = $data['comments'];
            unset($data['comments']);
        }

        $order = parent::update($model, $data);

        DB::commit();

        event(new OrderUpdatedEvent($order, $comments, $this->generateEventOptionsForModel()));

        return $order;
    }


    /**
     * shorten the search based on search criteria
     *
     * @param $searchCriteria
     * @return mixed
     */
    private function applyFilterInOrderSearch($searchCriteria)
    {
        if (isset($searchCriteria['query'])) {
            $searchCriteria['id'] = $this->model->where('invoice', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('name', 'like', '%' . $searchCriteria['query'] . '%')
                ->pluck('id')->toArray();
            unset($searchCriteria['query']);
        }

        if (isset($searchCriteria['campaignId'])) {
            $productOfferRepository = app(ProductOfferRepository::class);
            $productOfferIds = $productOfferRepository->model->select('id')->where('campaignId', $searchCriteria['campaignId'])->pluck('id')->toArray();

            $productDetailRepository = app(OrderDetailRepository::class);
            $searchCriteria['id'] = $productDetailRepository->model->select('orderId')->whereIn('productId', $productOfferIds)->pluck('orderId')->toArray();

            if (isset($searchCriteria['id'])) {
                if (is_array($searchCriteria['id'])) {
                    $searchCriteria['id'] = array_intersect($searchCriteria['id'], $productOfferIds);
                } else {
                    $searchCriteria['id'] = array_intersect(explode(',', $searchCriteria['id']), $productOfferIds);
                }
            } else {
                $searchCriteria['id'] = $productOfferIds;
            }

            unset($searchCriteria['campaignId']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = is_array($searchCriteria['id']) ? implode(",", array_unique($searchCriteria['id'])) : $searchCriteria['id'];
        }

        return $searchCriteria;
    }
}
