<?php

namespace App\Http\Requests\OrderReport;

use App\DbModels\OrderReport;
use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \ReflectionException
     */
    public function rules()
    {
        return [
            'createdByUserId' => 'exists:users,id',
            'orderId' => 'exists:orders,id',
            'status' => 'in:' . implode(',', OrderReport::getConstantsByPrefix('STATUS_')),
            'type' => 'required|in:' . implode(',', OrderReport::getReportTypes()),
            'comments' => '',
        ];
    }
}
