<?php

namespace App\Events\ProductStock;

use App\DbModels\ProductStock;
use Illuminate\Queue\SerializesModels;

class ProductStockCreatedEvent
{
    use SerializesModels;

    /**
     * @var ProductStock
     */
    public $productStock;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param ProductStock $productStock
     * @param array $options
     */
    public function __construct(ProductStock $productStock, array $options = [])
    {
        $this->productStock = $productStock;
        $this->options = $options;
    }

}
