<?php

namespace App\Http\Requests\OrderReportComment;

use App\Http\Requests\Request;
use ReflectionException;

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
            "createdByUserId" => 'exists:users,id',
            "orderReportId" => 'exists:order_reports,id',
        ];
    }
}
