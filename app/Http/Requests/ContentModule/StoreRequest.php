<?php

namespace App\Http\Requests\ContentModule;

use App\DbModels\ContentModule;
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
            'createdByUserId' => 'exists:users,id',
            'categoryId' => 'exists:categories,id',
            'subCategoryId' => 'exists:sub_categories,id',
            'title' => 'required|min:3',
            'params' => 'nullable',
            'type' => 'required|in:'  . implode(',', ContentModule::getConstantsByPrefix('TYPE_')),
        ];
    }
}
