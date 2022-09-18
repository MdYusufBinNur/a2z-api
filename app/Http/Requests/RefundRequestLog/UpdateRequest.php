<?php

namespace App\Http\Requests\RefundRequestLog;

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
            'refundRequestId' => 'exists:refund_requests,id',
            'comment' => '',
            'status' => 'in:'. implode(',', RefundRequest::getConstantsByPrefix('STATUS_')),
            'assignedToUserId' => 'exists:users,id'
        ];
    }
}
