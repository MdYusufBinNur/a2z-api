<?php

namespace App\Events\OrderReportComment;

use App\DbModels\OrderReportComment;
use Illuminate\Queue\SerializesModels;

class OrderReportCommentCreatedEvent
{
    use SerializesModels;

    /**
     * @var OrderReportComment
     */
    public $orderReportComment;
    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param OrderReportComment $orderReportComment
     * @param array $options
     */
    public function __construct(OrderReportComment $orderReportComment, array $options = [])
    {
        $this->orderReportComment = $orderReportComment;
        $this->options = $options;
    }
}
