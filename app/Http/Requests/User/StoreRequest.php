<?php

namespace App\Http\Requests\User;

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
        return $rules = [
            'email' => 'email|required_without:phone|unique:users|max:255',
            'phone' => 'required_without:email|unique:users', // todo |phone:BD
            'name' => 'max:255',
            'password' => 'required|min:6|max:255',
            'locale' => 'in:en,bn',
            'isActive' => 'boolean',
            'role' => '',
            'role.roleId' => 'required|exists:roles,id',
        ];
    }

}
