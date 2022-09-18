<?php

namespace App\Http\Requests\UserNotificationSetting;

use App\DbModels\UserNotificationSetting;
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
            'userNotificationSettings' => '',
            'userNotificationSettings.*.typeId' => 'required|exists:user_notification_types,id',
            'userNotificationSettings.*.userId' => 'required|exists:users,id',
            'userNotificationSettings.*.email' => 'boolean',
            'userNotificationSettings.*.sms' => 'boolean'
        ];
    }
}
