<?php

namespace App\Listeners\PaymentTransaction;

use App\DbModels\Payment;
use App\DbModels\PaymentTransaction;
use App\Events\PaymentItemTransaction\PaymentTransactionUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentTransactionUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentTransactionUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentTransactionUpdatedEvent $event)
    {
        $paymentTransaction = $event->paymentTransaction;
        $eventOptions = $event->options;
        $oldPaymentItemTransaction = $eventOptions['oldModel'];

        if ($paymentTransaction->status == PaymentTransaction::STATUS_SUCCESS) {
            $paymentItem = $paymentTransaction->paymentItem;
            $paymentItemRepository = app(PaymentRepository::class);
            $paymentItemRepository->update($paymentItem, ['status' => Payment::STATUS_PAID]);
        }
    }
}
