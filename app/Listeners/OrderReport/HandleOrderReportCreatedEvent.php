<?php

namespace App\Listeners\OrderReport;

use App\Events\OrderReport\OrderReportCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleOrderReportCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  OrderReportCreatedEvent  $event
     * @return void
     */
    public function handle(OrderReportCreatedEvent $event)
    {
        $orderReport = $event->orderReport;
        $eventOptions = $event->options;
    }
}
