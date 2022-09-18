<?php

namespace App\Http\Requests\Payment;

use App\DbModels\Payment;
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
            'orderId' => 'list:string',
            'invoice' => 'string',
            'amount' => 'numeric',
            'paid' => 'numeric',
            'due' => 'numeric',
            'advance' => 'numeric',
            'dueDate' => 'date_format: Y-m-d H:i:s',
            'status' => 'in:' . implode(',', Payment::getConstantsByPrefix('STATUS_')),
            'allowedPaymentMethods' => '',
            'updatedByUserId' => 'list:string'
        ];
    }
}
