<?php

namespace App\Http\Requests\Income;

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
            'categoryId' => 'required|exists:income_categories,id',
            'sourceOfIncome' => 'required|max: 255',
            'amount' => 'required',
            'notes' => 'max:65535',
            'incomeDate' => 'required|date_format:Y-m-d',
        ];
    }
}
