<?php

namespace App\Http\Requests\Product;

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
            'name' => '',
            'surname' => '',
            'brand' => 'list:string',
            'brandId' => 'list:string',
            'categoryId' => 'list:string',
            'subCategoryId' => 'list:string',
            'vendor' => 'list:string',
            'vendorId' => 'list:string',
            'parentId' => 'list:string',
            'productOffer' => 'required_with:campaignId|boolean|in:1',
            'campaignId' => 'required_if:productOffer,==,1|list:string',
            'query' => '',
            'minPrice' => '',
            'maxPrice' => '',
            'withOutPagination' => ''
        ];
    }
}
