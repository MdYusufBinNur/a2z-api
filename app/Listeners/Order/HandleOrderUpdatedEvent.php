<?php

namespace App\Listeners\Order;

use App\DbModels\Order;
use App\DbModels\Payment;
use App\Events\Order\OrderUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\OrderLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleOrderUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var OrderLogRepository
     */
    private $orderLogRepository;

    /**
     * HandleOrderUpdatedEvent constructor.
     * @param OrderLogRepository $orderLogRepository
     */
    public function __construct(OrderLogRepository $orderLogRepository)
    {
        $this->orderLogRepository = $orderLogRepository;
    }
    /**
     * Handle the event.
     *
     * @param  OrderUpdatedEvent  $event
     * @return void
     */
    public function handle(OrderUpdatedEvent $event)
    {
        $order = $event->order;
        $comments = $event->comments;
        $eventOptions = $event->options;
        $oldOrder = $eventOptions['oldModel'];

        $orderLog['orderId'] = $order->id;
        $orderLog['comments'] = $comments;
        $orderLog['assignedToUserId'] = $order->assignedToUserId ?? null;

        $hasOrderStatusChanged = $this->hasAFieldValueChanged($order, $oldOrder, 'status');
        $hasOrderPaymentStatusChanged = $this->hasAFieldValueChanged($order, $oldOrder, 'paymentStatus');

        if($hasOrderPaymentStatusChanged && $order->paymentStatus === Payment::STATUS_REFUND_REQUEST && !empty($comments)) {
            $orderLog['status'] = $order->status;
            $orderLog['paymentStatus'] = Payment::STATUS_REFUND_REQUEST;
            $this->orderLogRepository->save($orderLog);
        }

        if($hasOrderStatusChanged && !empty($comments)) {
            if ($hasOrderStatusChanged['status'] === Order::STATUS_PENDING) {
                $orderLog['status'] = Order::STATUS_PENDING;
            } else if ($hasOrderStatusChanged['status'] === Order::STATUS_REQUEST) {
                $orderLog['status'] = Order::STATUS_REQUEST;

            } else if ($hasOrderStatusChanged['status'] === Order::STATUS_CONFIRMED) {
                $orderLog['status'] = Order::STATUS_CONFIRMED;

            } else if ($hasOrderStatusChanged['status'] === Order::STATUS_PROCESSING) {
                $orderLog['status'] = Order::STATUS_PROCESSING;

            } else if ($hasOrderStatusChanged['status'] === Order::STATUS_PICKED) {
                $orderLog['status'] = Order::STATUS_PICKED;

            } else if ($hasOrderStatusChanged['status'] === Order::STATUS_SHIPPED) {
                $orderLog['status'] = Order::STATUS_SHIPPED;

            } else if ($hasOrderStatusChanged['status'] === Order::STATUS_DELIVERED) {
                $orderLog['status'] = Order::STATUS_DELIVERED;
            } else {
                $orderLog['status'] = Order::STATUS_CANCELLED;
            }

            $this->orderLogRepository->save($orderLog);
        }
    }
}
