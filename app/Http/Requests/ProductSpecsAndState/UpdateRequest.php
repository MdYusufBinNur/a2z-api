<?php

namespace App\Http\Requests\ProductSpecsAndState;

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
            'productId' => 'required|exists:product_specs_and_states,productId',
            'specifications' => [],
            'productStates' => [],
        ];
    }
}
