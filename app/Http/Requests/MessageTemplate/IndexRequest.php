<?php

namespace App\Http\Requests\MessageTemplate;

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
            'propertyId' => 'list:string',
            'title' => 'string',
            'text' => 'string',
        ];
    }
}
