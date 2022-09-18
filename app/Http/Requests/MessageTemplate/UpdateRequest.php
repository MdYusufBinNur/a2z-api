<?php

namespace App\Http\Requests\MessageTemplate;

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
            'propertyId' => 'exists:properties,id',
            'title' => 'max:255',
            'text' => 'max:16777215',
        ];
    }
}
