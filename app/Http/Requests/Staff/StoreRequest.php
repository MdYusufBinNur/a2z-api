<?php

namespace App\Http\Requests\Staff;

use App\DbModels\Role;
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
            'contactEmail' => 'email|required|max:255',
            'phone' => 'required', // phone:BD
            'title' => 'max:255',
            'level' => ['in:'. Role::ROLE_STAFF_STANDARD['title'] . ',' . Role::ROLE_STAFF_LIMITED['title']],

            'userId' => 'required_without:user|exists:users,id|unique_with:staffs,userId,level=level',
            'user' => 'required_without:userId',
            'user.email' => 'required_with:user|email|unique:users,email|max:255',
            'user.phone' => 'required_with:user',
            'user.name' => 'required_with:user|max:255',
            'user.password' => 'required_with:user|min:5|max:255',
            'user.locale' => 'in:en,bn',
            'user.isActive' => 'boolean'
        ];
    }
}
