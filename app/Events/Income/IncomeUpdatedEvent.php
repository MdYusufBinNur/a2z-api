<?php

namespace App\Events\Income;

use App\DbModels\Income;
use Illuminate\Queue\SerializesModels;

class IncomeUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Income
     */
    public $income;

    /**
     * Create a new event instance.
     *
     * @param Income $income
     * @param array $options
     */
    public function __construct(Income $income, array $options = [])
    {
        $this->income = $income;
        $this->options = $options;
    }
}
