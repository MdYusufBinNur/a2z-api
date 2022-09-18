<?php

namespace App\Http\Requests\Product;

use App\DbModels\ProductStock;
use App\Http\Requests\Request;
use App\Rules\CSVString;

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
            'brandId' => 'exists:brands,id',
            'parentId' => 'exists:products,id',
            'subCategoryId' => 'exists:sub_categories,id',
            'categoryId' => 'exists:categories,id',
            'vendorId' => 'exists:vendors,id',
            'name' => 'min:2',
            'surname' => '',
            'shortIntroduction' => '',
            'description' => ''
        ];
    }
}
