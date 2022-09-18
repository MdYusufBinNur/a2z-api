<?php

namespace App\Listeners\ProductStockOutLog;

use App\Events\ProductStockOutLog\ProductStockOutLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleProductStockOutLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param ProductStockOutLogCreatedEvent $event
     * @return void
     */
    public function handle(ProductStockOutLogCreatedEvent $event)
    {
        $product = $event->productStockOutLog;
        $eventOptions = $event->options;
    }
}
