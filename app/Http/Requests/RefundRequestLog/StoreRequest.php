<?php

namespace App\Http\Requests\RefundRequestLog;

use App\DbModels\RefundRequest;
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
            'createdByUserId' => 'exists:users,id',
            'refundRequestId' => 'required|exists:refund_requests,id',
            'comment' => 'required|min:10',
            'status' => 'in:'. implode(',', RefundRequest::getConstantsByPrefix('STATUS_')),
            'assignedToUserId' => 'required|exists:users,id'
        ];
    }
}
