<?php

namespace App\Http\Requests\PaymentLog;

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
            'createdByUserId'=> 'list:string',
            'paymentId' => 'list:string',
            'paymentTransactionId' => 'list:string',
            'paymentMethod' => 'list:string',
            'updatedByUserId' => 'list:string',
            'cashReceivedById' => 'list:string',
            'status' => '',
            'event' => '',
            'paid' => '',
            'due' => '',
            'advance' => '',
            'note' => ''
        ];
    }
}
