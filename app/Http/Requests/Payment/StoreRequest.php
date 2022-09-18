<?php

namespace App\Http\Requests\Payment;

use App\DbModels\Payment;
use App\DbModels\PaymentRecurring;
use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'orderId' => 'list:string',
            'invoice' => 'string',
            'amount' => 'numeric',
            'dueDate' => 'date_format: Y-m-d H:i:s',
            'status' => 'in:' . implode(',', Payment::getConstantsByPrefix('STATUS_'))
        ];
    }
}
