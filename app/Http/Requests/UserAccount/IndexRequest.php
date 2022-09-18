<?php

namespace App\Http\Requests\UserAccount;

use App\DbModels\UserAccount;
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
            'userId' => 'list:string',
            'balanceAmount' => 'numeric',
            'holdingAmount' => 'numeric',
            'giftCardAmount' => 'numeric',
            'cashbackAmount' => 'numeric',
            'status' => 'in:'. implode(',', UserAccount::getConstantsByPrefix('STATUS_')),
            'note' => 'string',
            'currency' => 'string',
            'updatedByUserId' => 'list:string'
        ];
    }
}
