<?php

namespace App\Http\Requests\Voucher;

use App\DbModels\Voucher;
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
            "createdByUserId" => 'exists:users,id',
            "toUserId" => 'required|exists:users,id',
            "code" => 'required',
            "status" => 'in:'. implode(',', Voucher::getConstantsByPrefix('STATUS_')),
            "expiredAt" => 'required|date_format: Y-m-d H:i:s',
            "isClaimed" => 'boolean',
            'note' => '',
        ];
    }
}
