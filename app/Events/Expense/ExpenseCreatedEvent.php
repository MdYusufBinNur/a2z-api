<?php

namespace App\Events\Expense;

use App\DbModels\Expense;
use Illuminate\Queue\SerializesModels;

class ExpenseCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;
    /**
     * @var Expense
     */
    public $expense;

    /**
     * Create a new event instance.
     *
     * @param Expense $expense
     * @param array $options
     */
    public function __construct(Expense $expense, array $options = [])
    {
        $this->expense = $expense;
        $this->options = $options;
    }
}
