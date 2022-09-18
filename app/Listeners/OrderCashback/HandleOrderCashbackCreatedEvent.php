<?php

namespace App\Listeners\OrderCashback;

use App\DbModels\OrderDetail;
use App\DbModels\UserAccountLog;
use App\Events\OrderCashback\OrderCashbackCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\OrderDetailRepository;
use App\Repositories\Contracts\UserAccountLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleOrderCashbackCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var OrderDetailRepository
     */
    private $orderDetailRepository;

    /**
     * @var UserAccountLogRepository
     */
    private $userAccountLogRepository;


    /**
     * HandleOrderUpdatedEvent constructor.
     * @param OrderDetailRepository $orderDetailRepository
     * @param UserAccountLogRepository $userAccountLogRepository
     */
    public function __construct(OrderDetailRepository $orderDetailRepository, UserAccountLogRepository $userAccountLogRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
        $this->userAccountLogRepository = $userAccountLogRepository;
    }

    /**
     * Handle the event.
     *
     * @param OrderCashbackCreatedEvent $event
     * @return void
     */
    public function handle(OrderCashbackCreatedEvent $event)
    {
        $orderCashback = $event->orderCashback;
        $eventOptions = $event->options;
        $orderDetail = $orderCashback->orderDetail;
        $userAccount = $orderCashback->userAccount;

        $orderDetailData['cashbackStatus'] = OrderDetail::CASHBACK_STATUS_ADDED;
        $this->orderDetailRepository->update($orderDetail, $orderDetailData);

        $this->userAccountLogRepository->save([
            'userAccountId' => $orderCashback->userAccountId,
            'type' => UserAccountLog::TYPE_CASHBACK,
            'resourceId' => $orderCashback->id,
            'resourceType' => UserAccountLog::RESOURCE_TYPE_ORDER_CASHBACK,
            'method' => UserAccountLog::METHOD_IN,
            'amount' => $orderCashback->cashbackAmount,
            'reason' => $orderCashback->cashbackAmount . ' cashback amount has been added in your account for invoice no ' . $orderDetail->invoice,
            'date' => $orderCashback->date,
        ]);
    }
}
