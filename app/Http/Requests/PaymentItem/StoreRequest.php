<?php

namespace App\Http\Requests\PaymentItem;

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
            'paymentMethodId' => 'required|exists:payment_methods,id',
            'paymentId' => 'required|exists:payments,id',
            'providerName' => 'required|min:3',
            'vouchedId' => '',
            'invoice' => 'required|string',
            'paymentDate' => 'date_format:Y-m-d',
            'amount' => 'numeric',
            'note' => 'string|max:65535'
        ];
    }
}
