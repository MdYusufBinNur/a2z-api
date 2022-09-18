<?php

namespace App\Http\Requests\Voucher;

use App\DbModels\Voucher;
use App\Http\Requests\Request;
use ReflectionException;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws ReflectionException
     */
    public function rules()
    {
        return [
            "updatedByUserId" => 'exists:users,id',
            "toUserId" => 'exists:users,id',
            "code" => '',
            "status" => 'in:' . implode(',', Voucher::getConstantsByPrefix('STATUS_')),
            "expiredAt" => 'date_format:Y-m-d H:i:s',
            "isClaimed" => 'boolean',
            'claimedAt' => 'date_format: Y-m-d H:i:s',
            'note' => '',
        ];
    }
}
