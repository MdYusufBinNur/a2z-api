<?php

namespace App\Http\Requests\RefundRequestLog;

use App\DbModels\RefundRequest;
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
            'refundRequestId' => 'list:string',
            'status' => 'in:'. implode(',', RefundRequest::getConstantsByPrefix('STATUS_')),
            'assignedToUserId' => 'list:string'
        ];
    }
}
