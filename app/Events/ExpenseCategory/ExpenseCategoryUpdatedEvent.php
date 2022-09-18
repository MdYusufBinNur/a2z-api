<?php

namespace App\Events\ExpenseCategory;

use App\DbModels\ExpenseCategory;
use Illuminate\Queue\SerializesModels;

class ExpenseCategoryUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ExpenseCategory
     */
    public $expenseCategory;

    /**
     * Create a new event instance.
     *
     * @param ExpenseCategory $expenseCategory
     * @param array $options
     */
    public function __construct(ExpenseCategory $expenseCategory, array $options = [])
    {
        $this->expenseCategory = $expenseCategory;
        $this->options = $options;
    }
}
