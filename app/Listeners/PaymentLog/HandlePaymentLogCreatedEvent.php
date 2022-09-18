<?php

namespace App\Listeners\PaymentLog;

use App\DbModels\UserNotificationType;
use App\Events\PaymentLog\PaymentLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PaymentRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * HandleOrderUpdatedEvent constructor.
     * @param PaymentRepository $paymentRepository
     */
    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentLogCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentLogCreatedEvent $event)
    {
        $paymentLog = $event->paymentLog;
        $payment = $paymentLog->payment;
        $eventOptions = $event->options;

        $paymentData['status'] = $paymentLog->status;
        $paymentData['due'] = $paymentLog->due;
        $paymentData['advance'] = $payment->advance + $paymentLog->advance;

        $paid = $payment->paid + $paymentLog->paid;

        if($paid > $payment->amount) {
            $paymentData['paid'] = $payment->paid;
        } else {
            $paymentData['paid'] = $paid;
        }

        $this->paymentRepository->updatePayment($payment, $paymentData);

        $userNotificationRepository = app(UserNotificationRepository::class);
        $userNotificationRepository->save([
            'toUserId' => $payment->createdByUserId,
            'userNotificationTypeId' => UserNotificationType::PAYMENT_ITEM_CREATED['id'],
            'resourceId' => $payment->orderId,
            'message' => $paymentLog->note
        ]);
    }
}
