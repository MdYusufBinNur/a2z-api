<?php

namespace App\Events\PaymentTransaction;

use App\DbModels\PaymentTransaction;
use Illuminate\Queue\SerializesModels;


class PaymentTransactionCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PaymentTransaction
     */
    public $paymentTransaction;

    /**
     * Create a new event instance.
     *
     * @param PaymentTransaction $paymentTransaction
     * @param array $options
     */
    public function __construct(PaymentTransaction $paymentTransaction, array $options = [])
    {
        $this->paymentTransaction = $paymentTransaction;
        $this->options = $options;
    }
}
