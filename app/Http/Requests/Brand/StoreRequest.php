<?php

namespace App\Http\Requests\Brand;

use App\DbModels\Brand;
use App\Http\Requests\Request;
use ReflectionException;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws ReflectionException
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'tag' => 'in:'. implode(',', Brand::getConstantsByPrefix('TAG_')),
            'categoryId' => 'exists:categories,id',
            'ownerName' => '',
            'address' => '',
        ];
    }
}
