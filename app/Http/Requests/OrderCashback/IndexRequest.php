<?php

namespace App\Http\Requests\OrderCashback;

use App\DbModels\OrderCashback;
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
            'createdByUserId' => 'list:numeric',
            'orderDetailId' => 'list:numeric',
            'userAccountId' => 'list:numeric',
            'cashbackAmount' => 'float',
            'date' => 'date_format:Y-m-d',
        ];
    }
}
