<?php

namespace App\Listeners\Income;

use App\Events\Income\IncomeCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleIncomeCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  IncomeCreatedEvent  $event
     * @return void
     */
    public function handle(IncomeCreatedEvent $event)
    {
        $income = $event->income;
        $eventOptions = $event->options;
    }
}
