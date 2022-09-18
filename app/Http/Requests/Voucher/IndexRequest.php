<?php

namespace App\Http\Requests\Voucher;

use App\DbModels\Voucher;
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
            'createdByUserId' => 'list:string',
            'toUserId' => 'list:string',
            'code' => 'string',
            'status' => 'in:'. implode(',', Voucher::getConstantsByPrefix('STATUS_')),
            'expiredAt' => '',
            'isClaimed' => '',
            'claimedAt' => '',
            'note' => '',
        ];
    }
}
