<?php

namespace App\Listeners\PaymentMethod;

use App\Events\PaymentMethod\PaymentMethodUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentMethodUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentMethodUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentMethodUpdatedEvent $event)
    {
        $paymentMethod = $event->paymentMethod;
        $eventOptions = $event->options;
        $oldPaymentMethod = $eventOptions['oldModel'];
    }
}
