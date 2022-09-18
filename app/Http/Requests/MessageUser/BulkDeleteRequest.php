<?php

namespace App\Http\Requests\MessageUser;

use App\Http\Requests\Request;
use App\Rules\ListOfIds;

class BulkDeleteRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'messageUserIds' => ['required', new ListOfIds('message_users', 'id')],
        ];
    }
}
