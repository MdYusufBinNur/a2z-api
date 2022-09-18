<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;
use App\Rules\UserEmailOrPhoneExists;

class LoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone' => ['required_without:email', 'max:255', new UserEmailOrPhoneExists()],
            'email' => ['required_without:phone', 'max:255', new UserEmailOrPhoneExists()],
            'password' => 'required',
        ];
    }
}
