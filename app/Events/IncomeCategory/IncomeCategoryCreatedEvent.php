<?php

namespace App\Events\IncomeCategory;

use App\DbModels\IncomeCategory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class IncomeCategoryCreatedEvent implements ShouldQueue
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var IncomeCategory
     */
    public $incomeCategory;

    /**
     * Create a new event instance.
     *
     * @param IncomeCategory $incomeCategory
     * @param array $options
     */
    public function __construct(IncomeCategory $incomeCategory, array $options = [])
    {
        $this->incomeCategory = $incomeCategory;
        $this->options = $options;
    }
}
