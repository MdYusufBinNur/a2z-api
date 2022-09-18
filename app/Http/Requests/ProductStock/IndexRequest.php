<?php

namespace App\Http\Requests\ProductStock;

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
            'updatedByUserId' => 'list:string',
            'price' => '',
            'oldPrice' => '',
            'status' => '',
            'type' => '',
            'availableQuantity' => 'numeric'
        ];
    }
}
