<?php

namespace App\Http\Requests\SubCategory;

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
            'name' => 'required',
            'categoryId' => 'required|exists:categories,id',
        ];
    }
}
