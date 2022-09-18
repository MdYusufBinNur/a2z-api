<?php

namespace App\Http\Requests\MessagePost;

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
            'messageId' => 'required|numeric',
            'fromUserId' => 'numeric',
        ];
    }
}
