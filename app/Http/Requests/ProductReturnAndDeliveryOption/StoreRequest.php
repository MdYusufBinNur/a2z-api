<?php

namespace App\Http\Requests\ProductReturnAndDeliveryOption;

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
            "createdByUserId" => 'exist:users,id',
            "productId" => 'required|exists:products,id',
            "deliveryOptions" => 'string',
            "returnOptions" => 'string',
            "isFreeDeliveryAvailable" => 'boolean',
            "isProductReturnable" => 'boolean'
        ];
    }
}
