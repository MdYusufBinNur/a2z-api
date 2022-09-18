<?php

namespace App\Listeners\PaymentMethod;

use App\Events\PaymentMethod\PaymentMethodCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentMethodCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentMethodCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentMethodCreatedEvent $event)
    {
        $paymentMethod = $event->paymentMethod;
        $eventOptions = $event->options;
    }
}
