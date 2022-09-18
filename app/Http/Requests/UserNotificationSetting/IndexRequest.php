<?php

namespace App\Http\Requests\UserNotificationSetting;

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
            'userId' => 'numeric',
            'typeId' => 'list:string'
        ];
    }
}
