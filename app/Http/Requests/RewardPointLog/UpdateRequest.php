<?php

namespace App\Http\Requests\RewardPointLog;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /***
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userId' => 'exists:users,id',
            'orderId' => 'exists:orders,id',
            'pointUsed' => '',

        ];
    }
}
