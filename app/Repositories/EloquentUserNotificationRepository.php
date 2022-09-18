<?php


namespace App\Repositories;


use App\Events\UserNotification\UserNotificationCreatedEvent;
use App\Repositories\Contracts\UserNotificationRepository;
use Carbon\Carbon;

class EloquentUserNotificationRepository extends EloquentBaseRepository implements UserNotificationRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $userNotification = parent::save($data);

        event(new UserNotificationCreatedEvent($userNotification, $this->generateEventOptionsForModel()));

        return $userNotification;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['toUserId'] = $searchCriteria['userId'] ?? $this->getLoggedInUser()->id;
        unset($searchCriteria['userId']);
        $searchCriteria['eagerLoad'] = ['un.toUser' => 'toUser', 'un.fromUser' => 'fromUser', 'un.type' => 'type'];
        $queryBuilder = $this->model;

        if (isset($searchCriteria['fromDate'])) {

            $fromDate = Carbon::parse($searchCriteria['fromDate']);
            $toDate = isset($searchCriteria['toDate']) ? Carbon::parse($searchCriteria['toDate']) : Carbon::now();

            $queryBuilder = $queryBuilder->whereDate('created_at','>=',$fromDate)->whereDate('created_at','<=',$toDate);

            unset($searchCriteria['fromDate']);
            unset($searchCriteria['toDate']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15; // it's needed for pagination
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function setUserNotificationReadStatus(array $data)
    {
        if (in_array('all', $data['notificationIds'])) {
            return $this->model->where('toUserId', $this->getLoggedInUser()->id)->update(['readStatus' => $data['readStatus']]);
        } else {
            return $this->model->where('toUserId', $this->getLoggedInUser()->id)->whereIn('id', $data['notificationIds'])->update(['readStatus' => $data['readStatus']]);

        }
    }

    /**
     * @inheritDoc
     */
    public function countUnreadNotificationOfTheCurrentUser()
    {
        return $this->model->where('toUserId', $this->getLoggedInUser()->id)
            ->where('readStatus', 0)
            ->count();
    }
}
