<?php

namespace App\Listeners\ProductStockInLog;

use App\Events\ProductStockInLog\ProductStockInLogCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleProductStockInLogCreatedEvent implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ProductStockInLogCreatedEvent $event
     * @return void
     */
    public function handle(ProductStockInLogCreatedEvent $event)
    {
        $productStockInLog = $event->productStockInLog;
        $eventOptions = $event->options;
    }
}
