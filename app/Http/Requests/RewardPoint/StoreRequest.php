<?php

namespace App\Http\Requests\RewardPoint;

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
            "createdByUserId" => 'exists:users,id',
            "userId" => 'required|exists:users,id',
            "used" => '',
            "availablePerUses" => '',
            "total" => '',
            "isClaimed" => '',
        ];
    }
}
