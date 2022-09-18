<?php

namespace App\Http\Requests\ProductStockInLog;

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
            'createdByUserId' => 'exists:users,id',
            'productId' => 'required|exists:product_stock_in_logs,productId',
            'vendorId' => 'exists:vendors,id',
            'date' => '',
            'cost' => 'required|numeric',
            'note' => '',
            'receivedQuantity' => ''
        ];
    }
}
