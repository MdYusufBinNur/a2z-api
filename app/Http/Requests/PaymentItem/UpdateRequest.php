<?php

namespace App\Http\Requests\PaymentItem;

use App\DbModels\PaymentItem;
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
            'paymentMethodId' => 'exists:payment_methods,id',
            'paymentDate' => 'date_format:Y-m-d',
            'providerName' => 'required|min:3',
            'amount' => 'max:6',
            'note' => 'string|max:65535',
            'status' => 'in:'. PaymentItem::STATUS_REQUEST . ',' .  PaymentItem::STATUS_SUCCESS . ',' . PaymentItem::STATUS_FAILED,
        ];
    }
}
