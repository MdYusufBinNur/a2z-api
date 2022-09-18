<?php

namespace App\Http\Requests\ContentModule;

use App\DbModels\ContentModule;
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
            'updatedByUserId' => 'list:string',
            'categoryId' => 'list:string',
            'subCategoryId' => 'list:string',
            'title' => '',
            'type' => 'required|in:'  . implode(',', ContentModule::getConstantsByPrefix('TYPE_')),
        ];
    }
}
