<?php

namespace App\Http\Requests\OrderLog;

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
            'assignedToUserId' => 'list:string',
            'orderId' => 'list:string',
            'status' => 'string',
            'comments' => 'string',
        ];
    }
}
