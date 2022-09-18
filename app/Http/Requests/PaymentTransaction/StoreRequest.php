<?php

namespace App\Http\Requests\PaymentTransaction;

use App\DbModels\PaymentTransaction;
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
            'paymentId' => 'required|exists:payments,id',
            'providerName' => 'required|min:3',
            'providerId' => 'required',
            'status' => 'required|in:' . PaymentTransaction::STATUS_SUCCESS . ',' . PaymentTransaction::STATUS_REJECTED . ',' . PaymentTransaction::STATUS_FAILED,
            'rawData' => '',
            'sourceURL' => 'required|max:255',
            'paymentProcessURL' => '',
        ];
    }
}
