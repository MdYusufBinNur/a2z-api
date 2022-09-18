<?php

namespace App\Http\Requests\ProductOffer;

use App\DbModels\ProductOffer;
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
            'vendorId' => 'required|exists:vendors,id',

            "productIds"    => "required|array",
            "productIds.*"  => "required|exists:products,id",

            'campaignId' => 'required|exists:campaigns,id',
            'cashback' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'cashbackType' => 'required_if:cashback, !=, null|in:'. implode(',', ProductOffer::getConstantsByPrefix('TYPE_')),
            'discountType' => 'required_if:discount, !=, null|in:'. implode(',', ProductOffer::getConstantsByPrefix('TYPE_')),

            'startDate' => 'date_format:Y-m-d',
            'startTime' => 'date_format:H:i:s',
            'endDate' => 'required|date_format:Y-m-d',
            'endTime' => 'required|date_format:H:i:s|after:startTime',
            'isActive' => 'boolean',
            'title' => 'nullable|min:3',
            'availableQuantity' => 'numeric'
        ];
    }
}
