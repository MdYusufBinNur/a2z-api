<?php

namespace App\Listeners\ProductStock;

use App\Events\ProductStock\ProductStockCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleProductStockCreatedEvent implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param ProductStockCreatedEvent $event
     * @return void
     */
    public function handle(ProductStockCreatedEvent $event)
    {
        $productStock = $event->productStock;
        $eventOptions = $event->options;
    }
}
