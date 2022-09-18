<?php

namespace App\Http\Requests\Tag;

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
            'productId'=> 'list:string',
            'title' => 'string',
            'type' => 'string',
            'value' => '',
        ];
    }
}
