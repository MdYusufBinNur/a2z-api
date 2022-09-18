<?php


namespace App\Repositories;


use App\DbModels\Payment;
use App\DbModels\PaymentInstallment;
use App\DbModels\PaymentItem;
use App\DbModels\PaymentRecurring;
use App\Events\Payment\PaymentCreatedEvent;
use App\Events\Payment\PaymentUpdatedEvent;
use App\Repositories\Contracts\PaymentInstallmentRepository;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\PaymentMethodRepository;
use App\Repositories\Contracts\PaymentPaymentMethodRepository;
use App\Repositories\Contracts\PaymentRecurringRepository;
use App\Repositories\Contracts\PaymentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EloquentPaymentRepository extends EloquentBaseRepository implements PaymentRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate('created_at', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $searchCriteria['eagerLoad'] = ['payment.createdByUser' => 'createdByUser',  'payment.paymentPaymentMethods' => 'paymentPaymentMethods',  'pp.createdByUser' => 'createdByUser', 'ppm.paymentMethod' => 'paymentPaymentMethods.paymentMethod'];
        $queryBuilder = $this->applyEagerLoad($queryBuilder, $searchCriteria);

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
     * @inheritDoc
     */
    public function savePayment(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $payment = $this->save($data);

        $this->setPaymentMethods($payment, $data);

        DB::commit();

//        event(new PaymentCreatedEvent($payment, $this->generateEventOptionsForModel()));

        return $payment;
    }

    /**
     * set payment methods
     * @param $payment
     * @param $data
     */
    private function setPaymentMethods($payment, $data)
    {
        if (isset($data['paymentMethodIds'])) {

            $paymentMethodRepository = app(PaymentMethodRepository::class);
            $paymentMethodRepository->setPaymentMethods($payment, $data['paymentMethodId']);
        }
    }


    /**
     * @inheritDoc
     */
    public function updatePayment(Payment $model, array $data): \ArrayAccess
    {
        // todo need to add validation for update payment status
//        $this->validatePaymentChanges($model, $data);

        DB::beginTransaction();

        $payment = $this->update($model, $data);

        DB::commit();

        return $payment;
    }

    /**
     * validate payment changes
     *
     * @param Payment $payment
     * @param array $data
     * @throws ValidationException
     */
    private function validatePaymentChanges(Payment $payment, array $data)
    {
        if (!(isset($data['status']))) {
            if (!$payment->isUpdateAble()) {
                throw ValidationException::withMessages([
                    'status' => ["Payment is already in process. You can't update it"]
                ]);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function removePayment(Payment $payment): bool
    {
        DB::beginTransaction();

        $paymentItemRepository = app(PaymentRepository::class);

        $paymentItems = $payment->paymentItems;
        foreach ($paymentItems as $paymentItem) {
            if (!$paymentItem->isPaid()) {
                $paymentItemRepository->update($paymentItem, ['status' => Payment::STATUS_CANCELLED]);
            }
        }
        $hasDeleted = $this->update($payment, ['status' => Payment::STATUS_CANCELLED]);

        DB::commit();

        return $hasDeleted instanceof Payment;
    }
}
