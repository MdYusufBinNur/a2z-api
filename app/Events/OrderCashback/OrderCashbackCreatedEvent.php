<?php

namespace App\Events\OrderCashback;

use App\DbModels\OrderCashback;
use Illuminate\Queue\SerializesModels;

class OrderCashbackCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var OrderCashback
     */
    public $orderCashback;

    /**
     * Create a new event instance.
     *
     * @param OrderCashback $orderCashback
     * @param array $options
     */
    public function __construct(OrderCashback $orderCashback, array $options = [])
    {
        $this->orderCashback = $orderCashback;
        $this->options = $options;
    }
}
