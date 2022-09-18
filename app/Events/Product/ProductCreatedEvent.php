<?php

namespace App\Events\Product;

use App\DbModels\Product;
use Illuminate\Queue\SerializesModels;

class ProductCreatedEvent
{
    use SerializesModels;

    /**
     * @var Product
     */
    public $product;

    /**
     * @var array
     */
    public $options;

    /**
     * @var array
     */
    public $productStockInLog;

    /**
     * @var array
     */
    public $productStock;

    /**
     * Create a new event instance.
     *
     * @param Product $product
     * @param array $productStock
     * @param array $productStockInLog
     * @param array $options
     */
    public function __construct(Product $product, array $productStock = [], array $productStockInLog = [], array $options = [])
    {
        $this->options = $options;
        $this->product = $product;
        $this->productStock = $productStock;
        $this->productStockInLog = $productStockInLog;
    }
}
