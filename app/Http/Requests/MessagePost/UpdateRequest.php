<?php

namespace App\Http\Requests\MessagePost;

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
            'messageId' => 'exists:messages,id',
            'fromUserId' => 'exists:users,id',
            'text' => 'max:16777215',
        ];
    }
}
