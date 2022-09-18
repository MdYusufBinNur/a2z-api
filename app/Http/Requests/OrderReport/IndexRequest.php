<?php

namespace App\Http\Requests\OrderReport;

use App\DbModels\OrderReport;
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
            'orderId' => 'list:string',
            'status' => 'string',
            'type' => 'in:' . implode(',', OrderReport::getReportTypes()),
            'comments' => '',
        ];
    }
}
