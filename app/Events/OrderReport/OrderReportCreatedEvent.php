<?php

namespace App\Events\OrderReport;

use App\DbModels\OrderReport;
use Illuminate\Queue\SerializesModels;


class OrderReportCreatedEvent
{
    use SerializesModels;

    /**
     * @var OrderReport
     */
    public $orderReport;
    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param OrderReport $orderReport
     * @param array $options
     */
    public function __construct(OrderReport $orderReport,  array $options = [])
    {
        $this->orderReport = $orderReport;
        $this->options = $options;
    }
}
