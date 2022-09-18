<?php

namespace App\Http\Requests\PaymentTransaction;

use App\DbModels\PaymentTransaction;
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
            'paymentId' => 'exists:payments,id',
            'providerName' => 'min:3',
            'providerId' => '',
            'status' => 'in:' . PaymentTransaction::STATUS_SUCCESS . ',' . PaymentTransaction::STATUS_REJECTED . ',' . PaymentTransaction::STATUS_FAILED,
            'rawData' => '',
            'sourceURL' => 'max:255',
        ];
    }
}
