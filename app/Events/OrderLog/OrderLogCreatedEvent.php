<?php

namespace App\Events\OrderLog;

use App\DbModels\OrderLog;
use Illuminate\Queue\SerializesModels;

class OrderLogCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var OrderLog
     */
    public $orderLog;
    /**
     * @var string
     */
    public $paymentStatus;

    /**
     * Create a new event instance.
     *
     * @param OrderLog $orderLog
     * @param string $paymentStatus
     * @param array $options
     */
    public function __construct(OrderLog $orderLog, string $paymentStatus, array $options = [])
    {
        $this->orderLog = $orderLog;
        $this->paymentStatus = $paymentStatus;
        $this->options = $options;
    }

}
