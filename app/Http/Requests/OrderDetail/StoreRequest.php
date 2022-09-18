<?php

namespace App\Http\Requests\OrderDetail;

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
            "orderId" => 'required|exists:orders,id',
            "productId" => 'required|exists:products,id',
            "productOfferId" => 'required|exists:product_offers,id',
            "productPrice" => 'required',
            "productQuantity" => 'required',
            'size' => '',
            'color' => '',
        ];
    }
}
