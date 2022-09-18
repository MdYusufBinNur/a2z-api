<?php

namespace App\Listeners\ExpenseCategory;

use App\Events\ExpenseCategory\ExpenseCategoryUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleExpenseCategoryUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ExpenseCategoryUpdatedEvent  $event
     * @return void
     */
    public function handle(ExpenseCategoryUpdatedEvent $event)
    {
        $expenseCategory = $event->expenseCategory;
        $eventOptions = $event->options;
        $oldExpenseCategory= $eventOptions['oldModel'];
    }
}
