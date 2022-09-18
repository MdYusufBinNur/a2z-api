<?php

namespace App\Http\Requests\IncomeCategory;

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
            'title' => 'string',
            'propertyId' => 'required|numeric',
        ];
    }
}
