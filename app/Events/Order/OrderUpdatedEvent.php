<?php

namespace App\Events\Order;

use App\DbModels\Order;
use Illuminate\Queue\SerializesModels;

class OrderUpdatedEvent
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
     * @var string
     */
    public $comments;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     * @param string $comments
     * @param array $options
     */
    public function __construct(Order $order, string $comments, array $options = [])
    {
        $this->order = $order;
        $this->comments = $comments;
        $this->options = $options;
    }
}
