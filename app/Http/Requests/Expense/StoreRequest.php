<?php

namespace App\Http\Requests\Expense;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'propertyId' => 'required|exists:properties,id',
            'categoryId' => 'required|exists:expense_categories,id',
            'expenseReason' => 'required|max: 255',
            'amount' => 'required',
            'notes' => 'max:65535',
            'expenseDate' => 'required|date_format:Y-m-d',
        ];
    }
}
