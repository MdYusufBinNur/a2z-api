<?php

namespace App\Http\Requests\UserProfile;

use App\DbModels\UserProfile;
use App\Http\Requests\Request;
use App\Rules\CSVString;
use Illuminate\Validation\Rule;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->request->get('userId');

        return [
            'userId' => 'exists:users,id',
            'gender' => 'nullable|in:'.UserProfile::GENDER_FEMALE.','.UserProfile::GENDER_MALE.','.UserProfile::GENDER_OTHERS,
            'occupation' => 'nullable|min:3|max:255',
            'homeTown' => 'nullable|max:255',
            'address' => 'nullable|max:255',
            'birthDate' => 'nullable|date_format:Y-m-d',
            'interests' => [new CSVString()],
            'user'                 => '',
            'user.name'            => 'min:3|max:255',
//            'user.phone' => [Rule::unique('users', 'phone')->ignore($userId, 'id'), 'phone:BD'],
            'user.email' => ['email', Rule::unique('users', 'email')->ignore($userId, 'id')],
        ];
    }
}
