<?php

namespace App\Http\Requests\Income;

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
            'categoryId' => 'exists:income_categories,id',
            'sourceOfIncome' => 'max: 255',
            'amount' => '',
            'notes' => 'max:65535',
            'incomeDate' => 'date_format:Y-m-d',
        ];
    }
}
