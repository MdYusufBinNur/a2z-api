<?php

namespace App\Http\Requests\Campaign;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'list:string',
            'createdByUserId' => 'list:string',
            'updatedByUserId' => 'list:string',
            'title' => '',
            'startDate' => 'date_format:Y-m-d',
            'startTime' => 'time_format:H:i:s',
            'endDate' => 'date_format:Y-m-d',
            'endTime' => 'time_format:H:i:s',
            'host' => '',
            'isActive' => 'boolean',
        ];
    }
}
