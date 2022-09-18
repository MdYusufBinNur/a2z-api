<?php

namespace App\Http\Requests\ProductSpecsAndState;

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
            'productId' => 'required|exists:products,id',
            'specifications' => [],
            'productStates' => [],
        ];
    }
}

