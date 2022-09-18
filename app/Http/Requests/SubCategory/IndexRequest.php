<?php

namespace App\Http\Requests\SubCategory;

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
            'name' => '',
            'categoryId' => 'exists:categories,id',
            'withOutPagination' => 'boolean'
        ];
    }
}
