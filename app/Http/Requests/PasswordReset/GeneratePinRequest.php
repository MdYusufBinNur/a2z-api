<?php

namespace App\Http\Requests\PasswordReset;

use App\DbModels\PasswordReset;
use App\Http\Requests\Request;
use App\Rules\UserEmailOrPhoneExists;

class GeneratePinRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \ReflectionException
     */
    public function rules()
    {
        return [
            'emailOrPhone' => ['required', 'max:255', new UserEmailOrPhoneExists()],
            'type' => 'required|in:' . implode(',', PasswordReset::getConstantsByPrefix('TYPE_')),
        ];
    }
}
