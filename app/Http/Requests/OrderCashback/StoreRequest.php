<?php

namespace App\Http\Requests\OrderCashback;

use App\Http\Requests\Request;
use App\Rules\OrderCashbackAmountValidate;
use App\Rules\OrderCashbackUserAccountValidate;

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
            'orderDetailId' => 'required|unique:order_cashbacks,orderDetailId',
            'userAccountId' => [new OrderCashbackUserAccountValidate($this->request)],
            "cashbackAmount" => [new OrderCashbackAmountValidate($this->request)],
        ];
    }
}
