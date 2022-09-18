<?php

namespace App\Listeners\Expense;

use App\Events\Expense\ExpenseCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleExpenseCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ExpenseCreatedEvent  $event
     * @return void
     */
    public function handle(ExpenseCreatedEvent $event)
    {
        $expense = $event->expense;
        $eventOptions = $event->options;
        $oldExpense = $eventOptions['oldModel'];
    }
}
