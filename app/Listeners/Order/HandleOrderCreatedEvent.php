<?php

namespace App\Listeners\Order;

use App\DbModels\Order;
use App\DbModels\OrderDetail;
use App\DbModels\Payment;
use App\DbModels\UserNotificationType;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\OrderDetailRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\PaymentRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleOrderCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderDetailRepository
     */
    private $orderDetailRepository;
    /**
     * @var PaymentRepository
     */
    private $paymentRepository;
    /**
     * @var UserNotificationRepository
     */
    private $userNotificationRepository;

    /**
     * HandleOrderUpdatedEvent constructor.
     * @param OrderDetailRepository $orderDetailRepository
     * @param OrderRepository $orderRepository
     * @param PaymentRepository $paymentRepository
     * @param UserNotificationRepository $userNotificationRepository
     */
    public function __construct(OrderDetailRepository $orderDetailRepository, OrderRepository $orderRepository, PaymentRepository $paymentRepository, UserNotificationRepository $userNotificationRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->paymentRepository = $paymentRepository;
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
        $order = $event->order;
        $products = $event->products;
        $eventOptions = $event->options;
        $createdByUserId = $order->createdByUserId;
        $orderId = $order->id;
        $invoice = $order->invoice;
        $amount = $order->amount;
        $vendor = $order->vendor;

        foreach ($products as $product) {
            $productDetail = $product;
            $productDetail['createdByUserId'] = $createdByUserId;
            $productDetail['orderId'] = $order->id;
            $productDetail['invoice'] = $invoice;
            $productDetail['cashbackStatus'] = OrderDetail::CASHBACK_STATUS_PENDING;
            $this->orderDetailRepository->save($productDetail);
        }

        $payment['createdByUserId'] = $createdByUserId;
        $payment['orderId'] = $orderId;
        $payment['invoice'] = $invoice;
        $payment['amount'] = $amount;
        $payment['paid'] = 0.0;
        $payment['due'] = $amount;
        $payment['advance'] = 0.0;
        $payment['status'] = Payment::STATUS_UNPAID;
        $payment['allowedPaymentMethods'] = implode(',', $vendor->acceptPaymentMethods);

        $this->paymentRepository->save($payment);

        $orderData['status'] = Order::STATUS_CONFIRMED;
        $orderData['comments'] = 'Thank you for placing order at ' . config('app.name') . '. We will process your order after payment is complete.';

        $this->orderRepository->update($order, $orderData);

        $this->userNotificationRepository->save([
            'fromVendorId' => $order->vendorId,
            'toUserId' => $createdByUserId,
            'userNotificationTypeId' => UserNotificationType::ORDER_REQUEST['id'],
            'resourceId' => $orderId,
            'message' => 'Thank you for placing order at ' . $order->vendor->name . '. We will contact to you soon.',
        ]);
    }
}
