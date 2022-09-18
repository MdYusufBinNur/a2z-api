<?php

namespace App\Http\Requests\Admin;

use App\DbModels\Admin;
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
            'userId' => 'required_without:users|exists:users,id',
            'level' => 'in:' . /*Admin::LEVEL_SUPER . ',' .*/ Admin::LEVEL_LIMITED . ',' . Admin::LEVEL_STANDARD,
            'users' => 'required_without:userId',
            'users.name' => 'required_without:userId|min:3|max:255',
            'users.email' => 'required_without:userId|email|unique:users,email|max:255',
            'users.phone' => 'required_without:userId|unique:users,phone',
            'users.isActive' => 'required_without:userId|boolean',
            'users.password' => 'required_without:userId|min:5|max:255',
        ];
    }
}
