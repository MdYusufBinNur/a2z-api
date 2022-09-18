<?php

namespace App\Http\Requests\OrderReportComment;

use App\DbModels\OrderReport;
use App\DbModels\OrderReportComment;
use App\Http\Requests\Request;
use ReflectionException;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws ReflectionException
     */
    public function rules()
    {
        return [
            'createdByUserId' => 'exists:users,id',
            'orderReportId' => 'required|exists:order_reports,id',
            'comments' => 'required|min:3',
            'status' => 'in:' . implode(',', OrderReport::getConstantsByPrefix('STATUS_')),
        ];
    }
}
