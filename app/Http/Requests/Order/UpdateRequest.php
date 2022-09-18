<?php

namespace App\Http\Requests\Order;

use App\DbModels\Order;
use App\DbModels\Payment;
use App\Http\Requests\Request;
use App\Rules\CSVString;
use ReflectionException;

class UpdateRequest extends Request
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
            "status" => 'in:' . implode(',', Order::getConstantsByPrefix('STATUS_')),
            "phone" => '',
            "address" => 'min:5',
//            "due" => 'float',
//            "paid" => 'float',
//            "paymentStatus" => 'in:' . implode(',', Payment::getConstantsByPrefix('STATUS_')),
            "createdByUserId" => 'exists:users,id',
            "assignedToUserId" => 'required|exists:users,id',
            "comments" => 'min:5',
        ];
    }
}
