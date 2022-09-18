<?php

namespace App\Http\Requests\Campaign;


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
        return [
            'updatedByUserId' => 'exists:users,id',
            'title' => 'min:3',
            'startDate' => 'date_format:Y-m-d',
            'startTime' => 'date_format:H:i:s',
            'endDate' => 'date_format:Y-m-d|',
            'endTime' => 'date_format:H:i:s|after:startTime',
            'description' => 'nullable',
            'host' => 'nullable',
            'isActive' => 'boolean',
        ];
    }
}
