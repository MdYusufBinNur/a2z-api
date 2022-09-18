<?php

namespace App\Http\Requests\Income;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:string',
            'createdByUserId' => 'list:string',
            'propertyId' => 'required|numeric',
            'categoryId' => 'list:string',
            'sourceOfIncome' => 'string',
            'amount' => '',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d|after:startDate',
            'withOutPagination' => 'boolean'
        ];
    }
}
