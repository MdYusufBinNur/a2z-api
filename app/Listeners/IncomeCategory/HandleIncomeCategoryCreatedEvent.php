<?php

namespace App\Listeners\IncomeCategory;

use App\Events\IncomeCategory\IncomeCategoryCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleIncomeCategoryCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  IncomeCategoryCreatedEvent  $event
     * @return void
     */
    public function handle(IncomeCategoryCreatedEvent $event)
    {
        $incomeCategory = $event->incomeCategory;
        $eventOptions = $event->options;
    }
}
