<?php

namespace App\Http\Requests\Message;

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
            'propertyId' => 'exists:properties,id',
            'fromUserId' => 'exists:users,id',
            'toUserId' => 'exists:users,id',
            'subject' => '',
            'isGroupMessage' => 'boolean',
            'group' => '',
            'groupNames' => '',
            'emailNotification' => 'boolean',
            'smsNotification' => 'boolean',
            'voiceNotification' => 'boolean',
        ];
    }
}
