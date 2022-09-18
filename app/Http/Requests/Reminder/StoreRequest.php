<?php

namespace App\Http\Requests\Reminder;

use App\DbModels\Reminder;
use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \ReflectionException
     */
    public function rules()
    {
        return [
            'toUserIds' => 'string',
            'reminderType' =>  'required|in:' . implode(',', Reminder::getConstantsByPrefix('REMINDER_TYPE_')),
            'resourceType' =>  'required|in:' . implode(',', Reminder::getConstantsByPrefix('RESOURCE_TYPE_')),
            'resourceId' => 'required|numeric',
        ];
    }
}
