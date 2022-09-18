<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserAccountLogRepository;
use Carbon\Carbon;

class EloquentUserAccountLogRepository extends EloquentBaseRepository implements UserAccountLogRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        unset($searchCriteria['userId']);
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


}
