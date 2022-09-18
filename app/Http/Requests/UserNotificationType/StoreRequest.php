<?php

namespace App\Http\Requests\UserNotificationType;

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
            'type' => 'required|min:3|max:255',
            'description' => 'max:255'
        ];
    }
}
