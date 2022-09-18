<?php

namespace App\Http\Requests\UserAddress;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

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
            'createdByUserId' => 'exists:users,id',
            'userId' => 'required|exists:users,id',
            'name' => 'required',
            'phone' => 'required|min:11',
            'division' => 'required|',
            'district' => 'required',
            'area' => 'required',
            'address' => 'required',
        ];
    }
}
