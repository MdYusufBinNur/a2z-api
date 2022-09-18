<?php

namespace App\Listeners\Payment;

use App\Events\Payment\PaymentUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * HandlePaymentCreatedEvent constructor.
     * @param PaymentRepository $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentUpdatedEvent $event)
    {
        $payment = $event->payment;
        $eventOptions = $event->options;
        $oldPayment = $eventOptions['oldModel'];

    }
}
