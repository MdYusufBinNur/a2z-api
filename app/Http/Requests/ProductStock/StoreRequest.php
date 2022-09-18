<?php

namespace App\Http\Requests\ProductStock;

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
            'updatedByUserId' => 'exist:users,id',
            'price' => '',
            'oldPrice' => '',
            'type' => '',
            'status' => '',
            'availableQuantity' => ''
        ];
    }
}
