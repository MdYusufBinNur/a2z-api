<?php

namespace App\Listeners\Expense;

use App\Events\Expense\ExpenseUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleExpenseUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ExpenseUpdatedEvent  $event
     * @return void
     */
    public function handle(ExpenseUpdatedEvent $event)
    {
        $expense = $event->expense;
        $eventOptions = $event->options;
        $oldExpense= $eventOptions['oldModel'];
    }
}
