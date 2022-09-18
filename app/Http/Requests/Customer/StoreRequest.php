<?php

namespace App\Http\Requests\Customer;

use App\DbModels\Customer;
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
            'name' => 'required|max:255',
            'email' => 'email|unique:customers|max:255',
            'phone' => 'required|unique:customers,phone',
            'isAgreeTC' => 'boolean',
            'level' => 'in:' . /*Customer::LEVEL_STAR  . ',' .*/  ',' . Customer::LEVEL_GENERAL,
            'userId' => 'required_without:user|exists:users,id|unique_with:staffs,userId,level=level',
            'user' => 'required_without:userId',
            'user.email' => 'required_without:phone|email|unique:users,email|max:255',
            'user.phone' => 'required_without:email|unique:users,phone',
            'user.name' => 'required_with:user|max:255',
            'user.locale' => 'in:en,bn',
        ];
    }
}


