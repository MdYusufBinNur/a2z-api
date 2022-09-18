<?php

namespace App\Events\PaymentItemTransaction;

use App\DbModels\PaymentItemTransaction;
use App\DbModels\PaymentTransaction;
use Illuminate\Queue\SerializesModels;

class PaymentTransactionUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var $paymentTransaction
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
