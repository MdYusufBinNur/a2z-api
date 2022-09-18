<?php

namespace App\Listeners\IncomeCategory;

use App\Events\IncomeCategory\IncomeCategoryUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleIncomeCategoryUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  IncomeCategoryUpdatedEvent  $event
     * @return void
     */
    public function handle(IncomeCategoryUpdatedEvent $event)
    {
        $incomeCategory = $event->incomeCategory;
        $eventOptions = $event->options;
        $oldIncomeCategory = $eventOptions['oldModel'];
    }
}
