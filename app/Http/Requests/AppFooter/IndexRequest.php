<?php

namespace App\Http\Requests\AppFooter;

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
            'title' => 'string',
            'link' => 'string',
            'content' => 'string',
            'details' => 'string',
            'query' => '',
        ];
    }
}
