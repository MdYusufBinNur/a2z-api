<?php

namespace App\Http\Requests\Tag;

use App\Http\Requests\Request;

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
            'productId'=> 'required|exists:products,id',
            'title' => 'required|string',
            'type' => 'required|string',
            'value' => '',
        ];
    }
}
