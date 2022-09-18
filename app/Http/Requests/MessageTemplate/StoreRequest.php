<?php

namespace App\Http\Requests\MessageTemplate;

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
            'propertyId' => 'required|exists:properties,id',
            'title' => 'required|max:255',
            'text' => 'required|max:16777215',
        ];
    }
}
