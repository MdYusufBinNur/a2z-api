<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;
use App\Rules\CSVString;
use App\Rules\OrderAmountValidate;

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
            "discount" => 'nullable',
            "phone" => 'required',
            "address" => 'required|min:5',
            'OrderType' => [new CSVString()],
            'voucherId' => 'nullable|exists:vouchers,id',
            'createdByUserId' => 'required|exists:users,id',
            'orderTypeId' => 'exists:order_types,id',
            'vendorId' => 'required|exists:vendors,id',
            'campaignId' => 'nullable|exists:campaigns,id',
            'acceptTAC' => 'boolean',

            // get and store all the products of an order
            'products' => '',
            'products.*.productId' => 'required|exists:products,id',
            'products.*.productOfferId' => 'nullable|exists:product_offers,id',
            'products.*.productPrice' => 'required',
            'products.*.productQuantity' => 'required',
            'products.*.size' => 'nullable',
            'products.*.color' => 'nullable',

//            "amount" => [new OrderAmountValidate($this->request)],
            "amount" => '',
        ];
    }
}
