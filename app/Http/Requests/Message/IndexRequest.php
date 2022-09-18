<?php

namespace App\Http\Requests\Message;

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
            'propertyId' => 'required|numeric',
            'fromUserId' => 'list:string',
            'toUserId' => 'list:string',
            'subject' => 'string',
            'isGroupMessage' => 'boolean',
            'group' => 'string',
            'groupNames' => 'string',
            'emailNotification' => 'boolean',
            'smsNotification' => 'boolean',
            'voiceNotification' => 'boolean',
        ];
    }
}
