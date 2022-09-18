<?php

namespace App\Http\Requests\UserAddress;

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
            'userId' => 'exists:users,id',
            'name' => '',
            'phone' => 'min:11',
            'division' => '',
            'district' => '',
            'area' => '',
            'address' => '',
            'updatedByUserId' => 'exists:users,id',
        ];
    }
}
