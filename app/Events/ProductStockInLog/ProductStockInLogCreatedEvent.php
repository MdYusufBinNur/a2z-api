<?php

namespace App\Events\ProductStockInLog;

use App\DbModels\ProductStockInLog;
use Illuminate\Queue\SerializesModels;

class ProductStockInLogCreatedEvent
{
    use SerializesModels;
    /**
     * @var ProductStockInLog
     */
    public $productStockInLog;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param ProductStockInLog $productStockInLog
     * @param array $options
     */
    public function __construct(ProductStockInLog $productStockInLog, array $options = [])
    {
        $this->productStockInLog = $productStockInLog;
        $this->options = $options;
    }

}
