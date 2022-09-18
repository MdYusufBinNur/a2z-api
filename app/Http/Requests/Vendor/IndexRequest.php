<?php

namespace App\Http\Requests\Vendor;

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
            'userId' => 'list:string',
            'userRoleId' => 'list:string',
            'campaignId' => 'list:string',
            'subCategoryIds' => 'list:string',
            'categoryId' => 'list:string',
            'name' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'address' => 'string',
            'website' => 'string',
            'query' => '',
            'tag' => 'string',
            'type' => 'string',
            'withOutPagination' => 'boolean'
        ];
    }
}
