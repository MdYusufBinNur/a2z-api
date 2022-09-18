<?php

namespace App\Http\Requests\UserNotification;

use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'notificationIds' => ['required', new ListOfIds('user_notifications', 'id', ['all'])],
            'readStatus' => 'required|boolean'
        ];
    }
}
