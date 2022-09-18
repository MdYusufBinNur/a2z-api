<?php

namespace App\Http\Requests\PaymentItem;

use App\DbModels\PaymentItem;
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
            'id' => 'list:numeric',
            'createdByUserId' => 'list:numeric',
            'paymentMethodId' => 'list:numeric',
            'paymentItemId' => 'list:numeric',
            'providerName' => '',
            'paymentDate' => 'date_format:Y-m-d',
            'status' => 'in:'. PaymentItem::STATUS_REQUEST . ',' .  PaymentItem::STATUS_SUCCESS . ',' . PaymentItem::STATUS_FAILED,
        ];
    }
}
