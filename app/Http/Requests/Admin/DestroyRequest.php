<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class DestroyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'completeDeletion' => 'boolean',
        ];
    }

}
