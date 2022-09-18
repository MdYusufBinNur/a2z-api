<?php


namespace App\Repositories\Contracts;


interface ProductStockInLogRepository extends BaseRepository
{

    /**
     * @param $data
     */
    public function updateProductStockAvailableQuantity($data);

}
