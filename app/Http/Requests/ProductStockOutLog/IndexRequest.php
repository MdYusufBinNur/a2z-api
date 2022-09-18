<?php

namespace App\Http\Requests\ProductStockOutLog;

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
            'resourceId' => 'list:string',
            'resourceItem' => '',
            'startingQuantity' => '',
            'availableQuantity' => '',
            'decreaseQuantity' => '',
            'note' => '',
            'amount' => '',
            'date' => '',
            'status' => ''
        ];
    }
}
