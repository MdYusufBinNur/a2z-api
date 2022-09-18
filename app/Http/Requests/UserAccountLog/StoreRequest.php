<?php

namespace App\Http\Requests\UserAccountLog;

use App\DbModels\UserAccountLog;
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
            'userAccountId' => 'required|exists:user_accounts,id',
            'type' => 'required|in:'. implode(',', UserAccountLog::getConstantsByPrefix('TYPE_')),
            'resourceId'  => 'numeric',
            'resourceType' => 'string',
            'amount' => 'required|numeric',
            'method' => 'required|in:'. implode(',', UserAccountLog::getConstantsByPrefix('METHOD_')),
            'reason' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
        ];
    }
}
