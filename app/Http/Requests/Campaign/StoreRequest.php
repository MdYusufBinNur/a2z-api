<?php

namespace App\Http\Requests\Campaign;

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
            'createdByUserId' => 'exists:users,id',
            'title' => 'required|min:3',
            'startDate' => 'date_format:Y-m-d',
            'startTime' => 'date_format:H:i:s',
            'endDate' => 'required|date_format:Y-m-d',
            'endTime' => 'required|date_format:H:i:s|after:startTime',
            'description' => 'nullable',
            'host' => 'nullable',
            'isActive' => 'boolean',
        ];
    }
}
