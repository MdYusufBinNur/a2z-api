<?php

namespace App\Http\Requests\UserAccount;

use App\DbModels\UserAccount;
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
            'createdByUserId' => 'exists:users,id',
            'userId' => 'required|exists:users,id',
            'balanceAmount' => 'numeric',
            'holdingAmount' => 'numeric',
            'giftCardAmount' => 'numeric',
            'cashbackAmount' => 'numeric',
            'status' => 'required|in:'. implode(',', UserAccount::getConstantsByPrefix('STATUS_')),
            'note' => 'string',
            'currency' => 'string',
        ];
    }
}
