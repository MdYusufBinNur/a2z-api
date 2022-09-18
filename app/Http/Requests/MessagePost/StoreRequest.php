<?php

namespace App\Http\Requests\MessagePost;

use App\Http\Requests\Request;
use App\Rules\ListOfIds;

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
            'messageId' => 'required|exists:messages,id',
            'text' => 'required|max:16777215',
            'attachmentIds' => [new ListOfIds('attachments', 'id')],
        ];
    }
}
