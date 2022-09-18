<?php

namespace App\Http\Requests\ProductOffer;

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
            'campaignId' => 'list:string',
            'title' => '',
            'discount' => '',
            'cashback' => '',
            'discountType' => '',
            'cashbackType' => '',
            'productId' => 'list:string',
            'vendorId' => 'list:string',
            'brandId' => 'list:string',
            'startDate' => 'date_format:Y-m-d',
            'startTime' => 'time_format:H:i:s',
            'endDate' => 'date_format:Y-m-d',
            'endTime' => 'time_format:H:i:s',
            'availableQuantity' => '',
        ];
    }
}
