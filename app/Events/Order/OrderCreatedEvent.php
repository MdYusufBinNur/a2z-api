<?php

namespace App\Events\Order;

use App\DbModels\Order;use Illuminate\Queue\SerializesModels;

class OrderCreatedEvent
{
    use SerializesModels;

    /**
     * @var Order
     */
    public $order;
    /**
     * @var array
     */
    public $options;
    /**
     * @var array
     */
    public $products;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     * @param array $products
     * @param array $options
     */
    public function __construct(Order $order, array $products, array $options = [])
    {
        $this->order = $order;
        $this->options = $options;
        $this->products = $products;
    }
}
