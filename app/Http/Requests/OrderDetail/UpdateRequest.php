<?php

namespace App\Http\Requests\OrderDetail;

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
            'productPrice' => '',
            'productQuantity' => '',
            'size' => '',
            'color' => '',
            'comment' => '',
        ];
    }
}
