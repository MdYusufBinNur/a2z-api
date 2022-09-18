<?php

namespace App\Http\Requests\UserNotification;

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
            'readStatus' => 'boolean',
            'userId' => 'required|numeric',
            'fromUserId' => 'numeric',
            'fromVendorId' => 'numeric',
            'fromDate' => 'date_format:Y-m-d',
            'toDate' => 'date_format:Y-m-d'
        ];
    }
}
