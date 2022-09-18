<?php

namespace App\Http\Requests\Brand;

use App\DbModels\Brand;
use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'string',
            'tag' => 'in:'. implode(',', Brand::getConstantsByPrefix('TAG_')),
            'categoryId' => 'exists:categories,id',
            'ownerName' => '',
            'address' => '',
        ];
    }
}
