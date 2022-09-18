<?php

namespace App\Events\PaymentMethod;

use App\DbModels\PaymentMethod;
use Illuminate\Queue\SerializesModels;

class PaymentMethodCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PaymentMethod
     */
    public $paymentMethod;

    /**
     * Create a new event instance.
     *
     * @param PaymentMethod $paymentMethod
     * @param array $options
     */
    public function __construct(PaymentMethod $paymentMethod, array $options = [])
    {
        $this->paymentMethod = $paymentMethod;
        $this->options = $options;
    }
}
