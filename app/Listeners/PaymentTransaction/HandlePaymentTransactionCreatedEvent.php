<?php

namespace App\Listeners\PaymentTransaction;

use App\DbModels\Order;
use App\DbModels\Payment;
use App\DbModels\UserNotificationType;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\OrderLogRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\PaymentLogRepository;
use App\Repositories\Contracts\PaymentRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentTransactionCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var UserNotificationRepository
     */
    private $userNotificationRepository;
    /**
     * @var PaymentLogRepository
     */
    private $paymentLogRepository;
    /**
     * @var PaymentRepository
     */
    private $paymentRepository;
    /**
     * @var OrderLogRepository
     */
    private $orderLogRepository;
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * HandleOrderUpdatedEvent constructor.
     * @param PaymentLogRepository $paymentLogRepository
     * @param PaymentRepository $paymentRepository
     * @param OrderLogRepository $orderLogRepository
     * @param OrderRepository $orderRepository
     * @param UserNotificationRepository $userNotificationRepository
     */
    public function __construct(PaymentLogRepository $paymentLogRepository, PaymentRepository $paymentRepository, OrderLogRepository $orderLogRepository, OrderRepository $orderRepository, UserNotificationRepository $userNotificationRepository)
    {
        $this->paymentLogRepository = $paymentLogRepository;
        $this->paymentRepository = $paymentRepository;
        $this->orderLogRepository = $orderLogRepository;
        $this->orderRepository = $orderRepository;
        $this->userNotificationRepository = $userNotificationRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $paymentTransaction = $event->paymentTransaction;
        $providerData = json_decode($paymentTransaction->rawData);
        $payment = $paymentTransaction->payment;
        $eventOptions = $event->options;

        $paymentLogData['paymentId'] = $paymentTransaction->paymentId;
        $paymentLogData['paymentTransactionId'] = $paymentTransaction->id;
        $paymentLogData['paymentMethod'] = $providerData->card_type;
        $paymentLogData['createdByUserId'] = $payment->createdByUserId;

        $status = Payment::STATUS_PARTIAL;
        $due = $payment->due;
        $advance = $payment->advance;

        if($due == $providerData->amount) {
            $status = Payment::STATUS_PAID;
            $due = 0;
        } else if ($due > $providerData->amount) {
            $status = Payment::STATUS_PARTIAL;
            $due = $due - $providerData->amount;
        } else {
            $status = Payment::STATUS_PAID;
            $due = 0;
            $advance = $providerData->amount - $due;
        }

        $paymentLogData['status'] = $status;
        $paymentLogData['paid'] = $providerData->amount;
        $paymentLogData['due'] = $due;
        $paymentLogData['advance'] = $advance;
        $paymentLogData['note'] = 'Thank you for payment ' . $providerData->amount . ' taka for the invoice ' . $payment->invoice;
        $paymentLog = $this->paymentLogRepository->save($paymentLogData);

        $paymentData['status'] = $paymentLog->status;
        $paymentData['due'] = $paymentLog->due;
        $paymentData['advance'] = $paymentLog->advance;
        $paid = $payment->paid + $paymentLog->paid;
        if($paid > $payment->amount) {
            $paymentData['paid'] = $payment->amount;
        } else {
            $paymentData['paid'] = $paid;
        }
        $this->paymentRepository->update($payment, $paymentData);


        $orderLog['orderId'] = $payment->orderId;
        if($paymentLog->status == Payment::STATUS_PAID) {
            $orderLog['status'] = Order::STATUS_PROCESSING;
        }
        $orderLog['comments'] = 'Tk. -' . $paymentLog->paid . ' payment received by ' . config('app.name') . '. Pay by Customer';
        $orderLog = $this->orderLogRepository->save($orderLog);

        $orderData['status'] = $orderLog->status;
        $orderData['paymentStatus'] = $paymentLog->status;
        $this->orderRepository->update($orderLog->order, $orderData);

        $this->userNotificationRepository->save([
            'toUserId' => $payment->createdByUserId,
            'userNotificationTypeId' => UserNotificationType::PAYMENT_ITEM_CREATED['id'],
            'resourceId' => $payment->orderId,
            'message' => $paymentLogData['note']
        ]);

    }
}
