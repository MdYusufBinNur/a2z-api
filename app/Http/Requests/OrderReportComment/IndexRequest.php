<?php

namespace App\Http\Requests\OrderReportComment;

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
            'orderReportId' => 'list:string',
            'createdByUserId' => 'list:string',
            'comments' => 'string',
            'status' => 'string',
        ];
    }
}
