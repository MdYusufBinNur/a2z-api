<?php

namespace App\Http\Requests\Expense;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categoryId' => 'exists:expense_categories,id',
            'expenseReason' => 'max: 255',
            'amount' => 'required',
            'notes' => 'max:65535',
            'expenseDate' => 'date_format:Y-m-d',
        ];
    }
}
