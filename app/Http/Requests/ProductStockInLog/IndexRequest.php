<?php

namespace App\Http\Requests\ProductStockInLog;

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
            'productId' => 'list:string',
            'vendorId' => 'list:string',
            'date' => '',
            'cost' => '',
            'note' => '',
            'startingQuantity' => '',
            'receivedQuantity' => '',
            'availableQuantity' => '',
        ];
    }
}
