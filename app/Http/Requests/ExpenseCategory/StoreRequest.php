<?php

namespace App\Http\Requests\ExpenseCategory;

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
            'title' => 'required|max:255',
            'propertyId' => 'required|exists:properties,id'
        ];
    }
}
