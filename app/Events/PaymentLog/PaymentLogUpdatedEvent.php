<?php

namespace App\Events\PaymentLog;

use App\DbModels\PaymentLog;
use Illuminate\Queue\SerializesModels;

class PaymentLogUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PaymentLog
     */
    public $paymentLog;

    /**
     * Create a new event instance.
     *
     * @param PaymentLog $paymentLog
     * @param array $options
     */
    public function __construct(PaymentLog $paymentLog, array $options = [])
    {
        $this->paymentLog = $paymentLog;
        $this->options = $options;
    }
}
