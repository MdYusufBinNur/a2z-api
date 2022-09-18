<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Request;
use App\Rules\CSVString;

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
            'name' => 'required|min:2|unique:categories,name',
            'similarCategories' => [new CSVString()]
        ];
    }
}
