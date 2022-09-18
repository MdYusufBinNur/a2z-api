<?php

namespace App\Listeners\OrderReportComment;

use App\DbModels\OrderReport;
use App\Events\OrderReportComment\OrderReportCommentCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\OrderReportLogRepository;
use App\Repositories\Contracts\OrderReportRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleOrderReportCommentCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var OrderReportLogRepository
     */
    private $orderReportLogRepository;
    /**
     * @var OrderReportRepository
     */
    private $orderReportRepository;

    /**
     * Create the event listener.
     *
     * @param OrderReportLogRepository $orderReportLogRepository
     * @param OrderReportRepository $orderReportRepository
     */
    public function __construct(OrderReportLogRepository $orderReportLogRepository, OrderReportRepository $orderReportRepository)
    {
        $this->orderReportLogRepository = $orderReportLogRepository;
        $this->orderReportRepository = $orderReportRepository;
    }

    /**
     * Handle the event.
     *
     * @param  OrderReportCommentCreatedEvent  $event
     * @return void
     */
    public function handle(OrderReportCommentCreatedEvent $event)
    {
        $orderReportComment = $event->orderReportComment;
        $orderReport = $orderReportComment->orderReport;
        $status = $orderReportComment->status;
        $eventOptions = $event->options;

        $this->orderReportRepository->update($orderReport, ['status' => $status, 'updatedByUserId' => $orderReportComment->createdByUserId]);
    }
}
