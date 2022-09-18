<?php

namespace App\Events\Payment;

use App\DbModels\Payment;
use Illuminate\Queue\SerializesModels;

class PaymentCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Payment
     */
    public $payment;

    /**
     * Create a new event instance.
     *
     * @param Payment $payment
     * @param array $options
     */
    public function __construct(Payment $payment, array $options = [])
    {
        $this->payment = $payment;
        $this->options = $options;
    }
}
