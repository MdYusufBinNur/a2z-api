<?php

namespace App\Http\Requests\MetaAndSlug;

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
            'resourceId' => 'list:string',
            'updatedByUserId' => 'list:string',
            'type' => 'string',
            'routePath' => 'routePath',
            'query' => 'query',
            'withOutPagination' => 'boolean'
        ];
    }
}
