<?php

namespace App\Http\Requests\Reminder;


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
            'createdByUserId' => 'numeric',
            'toUserIds' => 'list:string',
            'reminderType' => 'string',
            'resourceType' => 'string',
            'resourceId' => 'numeric',
        ];
    }
}
