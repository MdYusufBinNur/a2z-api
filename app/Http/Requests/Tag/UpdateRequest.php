<?php

namespace App\Http\Requests\Tag;

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
            'productId'=> 'exists:products,id',
            'title' => 'string',
            'type' => 'string',
            'value' => '',
        ];
    }
}
