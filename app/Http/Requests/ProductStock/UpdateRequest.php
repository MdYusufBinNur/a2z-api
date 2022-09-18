<?php

namespace App\Http\Requests\ProductStock;

use App\DbModels\ProductStock;
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
            'updatedByUserId' => 'exists:users,id',
            'productId' => 'required|exists:products,id',
            'price' => 'numeric',
            'oldPrice' => 'numeric',
            "status" => 'in:' . implode(',', ProductStock::getConstantsByPrefix('STATUS_')),
            "type" => 'in:' . implode(',', ProductStock::getConstantsByPrefix('TYPE_'))
        ];
    }
}
