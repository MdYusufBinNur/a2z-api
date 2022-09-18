<?php

namespace App\Http\Requests\PaymentTransaction;

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
            'paymentId' => 'list:string',
            'providerName' => '',
            'providerId' => '',
            'status' => 'list:string',
            'rawData' => '',
        ];
    }
}
