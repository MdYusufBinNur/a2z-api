<?php

namespace App\Http\Requests\Category;

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
            'subCategoryId' => 'list:string',
            'name' => 'string',
            'query' => '',
            'withOutPagination' => 'boolean'
        ];
    }
}
