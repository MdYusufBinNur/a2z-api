<?php

namespace App\Events\ProductStockOutLog;

use App\DbModels\ProductStockOutLog;


class ProductStockOutLogCreatedEvent
{
    /**
     * @var ProductStockOutLog
     */
    public $productStockOutLog;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param ProductStockOutLog $productStockOutLog
     * @param array $options
     */
    public function __construct(ProductStockOutLog $productStockOutLog, array $options = [])
    {
        $this->productStockOutLog = $productStockOutLog;
        $this->options = $options;
    }

}
