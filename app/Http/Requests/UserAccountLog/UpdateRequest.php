<?php

namespace App\Http\Requests\UserAccountLog;

use App\DbModels\UserAccountLog;
use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userAccountId' => 'exists:user_accounts,id',
            'type' => 'in:'. implode(',', UserAccountLog::getConstantsByPrefix('TYPE_')),
            'resourceId'  => 'numeric',
            'resourceType' => 'string',
            'amount' => 'numeric',
            'method' => 'in:'. implode(',', UserAccountLog::getConstantsByPrefix('METHOD_')),
            'reason' => '',
            'date' => 'date_format:Y-m-d',
            'updatedByUserId' => 'exists:users,id',
        ];
    }
}
