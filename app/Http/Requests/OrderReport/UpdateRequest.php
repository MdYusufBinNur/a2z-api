<?php

namespace App\Http\Requests\OrderReport;

use App\DbModels\OrderReport;
use App\Http\Requests\Request;

class UpdateRequest extends Request
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
            'status' => 'in:' . implode(',', OrderReport::getConstantsByPrefix('STATUS_')),
            'type' => 'in:' . implode(',', OrderReport::getConstantsByPrefix('TYPE_')),
            'comments' => '',
            'updatedByUserId' => '',
        ];
    }
}
