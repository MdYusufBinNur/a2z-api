<?php

namespace App\Http\Requests\ProductOffer;

use App\DbModels\ProductOffer;
use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vendorId' => 'exists:vendors,id',
            'brandId' => 'exists:brands,id',

            "productIds"    => "array",
            "productIds.*"  => "exists:products,id",

            'campaignId' => 'exists:campaigns,id',
            'cashback' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'cashbackType' => 'required_if:cashback, !=, null|in:'. implode(',', ProductOffer::getConstantsByPrefix('TYPE_')),
            'discountType' => 'required_if:discount, !=, null|in:'. implode(',', ProductOffer::getConstantsByPrefix('TYPE_')),
            'startDate' => 'date_format:Y-m-d',
            'startTime' => 'date_format:H:i:s',
            'endDate' => 'date_format:Y-m-d|',
            'endTime' => 'date_format:H:i:s|after:startTime',
            'isActive' => 'boolean',
            'title' => 'nullable|min:3',
            'availableQuantity' => 'numeric'
        ];
    }
}
