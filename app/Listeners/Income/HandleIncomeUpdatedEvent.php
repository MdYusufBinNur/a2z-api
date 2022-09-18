<?php

namespace App\Listeners\Income;

use App\Events\Income\IncomeUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleIncomeUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  IncomeUpdatedEvent  $event
     * @return void
     */
    public function handle(IncomeUpdatedEvent $event)
    {
        $income = $event->income;
        $eventOptions = $event->options;
        $oldIncome = $eventOptions['oldModel'];
    }
}
