<?php

namespace App\Listeners\RefundRequest;

use App\DbModels\Payment;
use App\Events\RefundRequest\RefundRequestCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\RefundRequestLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleRefundRequestCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var RefundRequestLogRepository
     */
    private $refundRequestLogRepository;

    /**
     * HandleOrderUpdatedEvent constructor.
     * @param OrderRepository $orderRepository
     * @param RefundRequestLogRepository $refundRequestLogRepository
     */
    public function __construct(OrderRepository $orderRepository, RefundRequestLogRepository $refundRequestLogRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->refundRequestLogRepository = $refundRequestLogRepository;
    }

    /**
     * Handle the event.
     *
     * @param RefundRequestCreatedEvent $event
     * @return void
     */
    public function handle(RefundRequestCreatedEvent $event)
    {
        $refundRequest = $event->refundRequest;
        $eventOptions = $event->options;

        $order = $refundRequest->order;
        $refundRequestLogData['refundRequestId'] = $refundRequest->id;
        $refundRequestLogData['status'] = $refundRequest->status;
        $refundRequestLogData['comment'] = $refundRequest->comment;
        $refundRequestLogData['assignedToUserId'] = $refundRequest->assignedToUserId;

        $this->refundRequestLogRepository->save($refundRequestLogData);

        if(in_array($order->paymentStatus, [Payment::STATUS_PAID, Payment::STATUS_PARTIAL])) {
            $orderData['paymentStatus'] = Payment::STATUS_REFUND_REQUEST;
            $orderData['comments'] = $refundRequest->comment;
            $this->orderRepository->update($order, $orderData);
        }
    }
}
