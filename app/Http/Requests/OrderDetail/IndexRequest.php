<?php

namespace App\Http\Requests\OrderDetail;

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
            'orderId' => 'list:string',
            'productId' => 'list:string',
            'productOfferId' => 'list:string',
            'productPrice' => 'float',
            'size' => '',
            'color' => '',
        ];
    }
}
