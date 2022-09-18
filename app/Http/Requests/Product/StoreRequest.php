<?php

namespace App\Http\Requests\Product;

use App\DbModels\ProductStock;
use App\Http\Requests\Request;
use App\Rules\CSVString;

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
            'brandId' => 'exists:brands,id',
            'categoryId' => 'required|exists:categories,id',
            'parentId' => 'exists:products,id',
            'subCategoryId' => 'exists:sub_categories,id',
            'vendorId' => 'required|exists:vendors,id',
            'name' => 'required|min:2',
            'surname' => '',
            'shortIntroduction' => '',
            'description' => '',

            "productStock" => 'required',
            "productStock.price" => 'required_with:productStock|numeric',
            "productStock.oldPrice" => "numeric",
            "productStock.status" => 'required_with:productStock|in:' . implode(',', ProductStock::getConstantsByPrefix('STATUS_')),
            "productStock.type" => 'required_with:productStock|in:' . implode(',', ProductStock::getConstantsByPrefix('TYPE_')),

            "productStockInLog" => 'required',
            "productStockInLog.receivedQuantity" => 'required_with:productStockInLog|numeric',
            "productStockInLog.date" => "required_with:productStockInLog|date_format:Y-m-d",
            "productStockInLog.note" => "required|max:255",
            "productStockInLog.cost" => "required_with:productStockInLog|numeric",

            "productSpecsAndState" => 'required',
            'productSpecsAndState.specifications' => [],
            'productSpecsAndState.productStates' => [],
        ];
    }
}
