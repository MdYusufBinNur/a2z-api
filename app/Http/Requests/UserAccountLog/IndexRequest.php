<?php

namespace App\Http\Requests\UserAccountLog;

use App\DbModels\UserAccountLog;
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
            'userId' => 'list:string',
            'createdByUserId' => 'list:string',
            'updatedByUserId' => 'list:string',
            'userAccountId' => 'list:string',
            'type' => 'in:'. implode(',', UserAccountLog::getConstantsByPrefix('TYPE_')),
            'resourceId'  => 'list:string',
            'resourceType' => 'string',
            'amount' => 'numeric',
            'method' => 'in:'. implode(',', UserAccountLog::getConstantsByPrefix('METHOD_')),
            'reason' => '',
            'date' => 'date_format:Y-m-d'
        ];
    }
}
