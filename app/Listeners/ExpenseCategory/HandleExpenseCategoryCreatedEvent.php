<?php

namespace App\Listeners\ExpenseCategory;

use App\Events\ExpenseCategory\ExpenseCategoryCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleExpenseCategoryCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ExpenseCategoryCreatedEvent  $event
     * @return void
     */
    public function handle(ExpenseCategoryCreatedEvent $event)
    {
        $expenseCategory = $event->expenseCategory;
        $eventOptions = $event->options;
    }
}
