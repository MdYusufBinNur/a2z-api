<?php

namespace App\Http\Requests\RefundRequest;

use App\DbModels\RefundRequest;
use App\Http\Requests\Request;
use App\Rules\RefundRequestAmountValidate;

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
            'createdByUserId' => 'exists:users,id',
            'orderId' => 'required|exists:orders,id',
            'paymentId' => 'required|exists:payments,id',
            'requestPaymentMethod'  => 'required',
            'amount' => ['required', new RefundRequestAmountValidate($this->request)],
            'comment' => '',
        ];
    }
}
