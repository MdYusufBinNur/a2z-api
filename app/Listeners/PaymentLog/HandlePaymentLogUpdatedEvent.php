<?php

namespace App\Listeners\PaymentLog;

use App\Events\PaymentLog\PaymentLogUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentLogUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentLogUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentLogUpdatedEvent $event)
    {
        $paymentItemLog = $event->paymentItemLog;
        $eventOptions = $event->options;
        $oldPaymentItemLog = $eventOptions['oldModel'];
    }
}
