<?php

namespace App\Listeners\OrderLog;

use App\DbModels\Order;
use App\DbModels\Payment;
use App\Events\OrderLog\OrderLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\OrderRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleOrderLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * Create the event listener.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Handle the event.
     *
     * @param OrderLogCreatedEvent $event
     * @return void
     */
    public function handle(OrderLogCreatedEvent $event)
    {
        $orderLog = $event->orderLog;
        $paymentStatus = $event->paymentStatus;
        $order = $orderLog->order;
        $eventOptions = $event->options;

        if($paymentStatus == Payment::STATUS_PAID) {
            $orderData['status'] = Order::STATUS_PROCESSING;
            $orderData['comments'] = 'Payment completed. Order selected for processing - ' . config('app.name');
        } else {
            $orderData['status'] = $orderLog->status;
        }

        $orderData['paymentStatus'] = $paymentStatus;

        $this->orderRepository->update($order, $orderData);
    }
}
