<?php

namespace App\Http\Requests\Order;

use App\DbModels\Order;
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
            'assignedToUserId' => 'list:string',
            "phone" => '',
            'status' => 'in:' . implode(',', Order::getConstantsByPrefix('STATUS_')),
            'invoice' => 'string',
            'amount' => 'float',
            'paid' => 'float',
            'voucherId' => 'list:string',
            'orderTypeId'  => 'list:string',
            'vendorId'  => 'list:string',
            'campaignId'  => 'list:string',
            'query'  => 'list:string',
            'startDate' => 'date_format:Y-m-d',
            'endDate' => 'date_format:Y-m-d',
            'withOutPagination' => '',
        ];
    }
}
