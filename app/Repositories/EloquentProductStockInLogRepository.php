<?php


namespace App\Repositories;

use App\DbModels\ProductStock;
use App\DbModels\ProductStockInLog;
use App\Repositories\Contracts\ProductStockInLogRepository;
use App\Repositories\Contracts\ProductStockRepository;
use ArrayAccess;
use Illuminate\Support\Facades\DB;

class EloquentProductStockInLogRepository extends EloquentBaseRepository implements ProductStockInLogRepository
{
    /**
     * inherit doc
     * @param array $data
     * @return ArrayAccess
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $previousProductStockInLog = $this->model->where(['productId' => $data['productId']])->latest('updated_at')->first();

        if($previousProductStockInLog instanceof ProductStockInLog) {
            $data['startingQuantity'] = $previousProductStockInLog->availableQuantity;
            $data['availableQuantity'] = $previousProductStockInLog->availableQuantity + $data['receivedQuantity'];
        } else {
            $data['startingQuantity'] = $data['receivedQuantity'];
            $data['availableQuantity'] = $data['receivedQuantity'];
        }

        $productStockInLog = parent::save($data);

        $this->updateProductStockAvailableQuantity($productStockInLog);

        DB::commit();

        return $productStockInLog;
    }

    /**
     * inherit doc
     * @param ArrayAccess $model
     * @param array $data
     * @return ArrayAccess
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data['startingQuantity'] = $model->startingQuantity;
        $data['availableQuantity'] = $model->startingQuantity + $data['receivedQuantity'];

        $productStockInLog = parent::update($model, $data);;

        $this->updateProductStockAvailableQuantity($productStockInLog);

        DB::commit();

        return $productStockInLog;
    }

    /**
     * @param $data
     */
    public function updateProductStockAvailableQuantity($data)
    {
        $productStockRepository = app(ProductStockRepository::class);

        $productStock = $productStockRepository->findOneBy(['productId' => $data['productId']]);

        if($productStock instanceof ProductStock) {
            $productStockRepository->update($productStock, ['availableQuantity' => $data['availableQuantity']]);
        }
    }
}
