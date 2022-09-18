<?php

namespace App\Http\Requests\PaymentMethod;

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
            'createdByUserId' => 'list:string',
            'updatedByUserId' => 'list:string',
            'title' => 'string',
            'link' => 'string',
            'discount' => 'string',
            'details' => 'string',
            'isActive' => 'boolean',
        ];
    }
}
