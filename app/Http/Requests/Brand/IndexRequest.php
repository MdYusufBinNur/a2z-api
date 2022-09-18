<?php

namespace App\Http\Requests\Brand;

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
            'categoryId' => 'list:string',
            'subCategoryId' => 'list:string',
            'title' => 'string',
            'tag' => 'string',
            'query' => '',
            'campaignId' => 'list:string',
            'withOutPagination' => 'boolean'
        ];
    }
}
