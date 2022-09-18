<?php

namespace App\Http\Requests\MessageUser;

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
            'userId' => 'required|numeric',
            'messageId' => 'list:string',
            'folder' => 'string',
            'isRead' => 'boolean',
        ];
    }
}
