<?php

namespace App\Http\Requests\Customer;

use App\DbModels\Customer;
use App\DbModels\UserProfile;
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
        $userId = null;
        $profileId = $this->segment(4);
        $userProfile = Customer::find($profileId);

        if ($userProfile instanceof UserProfile) {
            $userId = $userProfile->userId;
        }

        return [
            'name' => 'max:255',
            'email' => 'max:255',
            'level' => 'in:' . Customer::LEVEL_GENERAL . ',' . Customer::LEVEL_STAR ,
            'user' => '',
            'user.email' => 'max:255|email|unique:users,email,' . $userId . ',id',
            'user.name' => 'max:255',
            'user.locale' => 'in:en,bn',
        ];
    }
}
