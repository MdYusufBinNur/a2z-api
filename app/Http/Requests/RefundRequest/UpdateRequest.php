<?php

namespace App\Http\Requests\RefundRequest;

use App\DbModels\RefundRequest;
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
            'updatedByUserId' => 'exists:users,id',
            'orderId' => 'exists:orders,id',
            'requestPaymentMethod'  => '',
            'comment' => 'required',
            'status' => 'in:'. implode(',', RefundRequest::getConstantsByPrefix('STATUS_')),
            'assignedToUserId' => 'exists:users,id'
        ];
    }
}
