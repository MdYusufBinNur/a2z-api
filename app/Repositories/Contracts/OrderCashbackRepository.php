<?php


namespace App\Repositories\Contracts;


interface OrderCashbackRepository extends BaseRepository
{
    public function getCashbackAbleOrderLists(array $searchCriteria = [], $getAllData = true);

    public function getACashbackAbleOrderDetail(array $searchCriteria = [], $getAllData = false);
}
