<?php

namespace App\Http\Requests\UserAddress;

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
            'userId' => 'list:string',
            'name' => 'string',
            'phone' => 'string',
            'division' => 'string',
            'district' => 'string',
            'area' => 'string',
            'address' => 'address',
            'updatedByUserId' => 'list:string'
        ];
    }
}
