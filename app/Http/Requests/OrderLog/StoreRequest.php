<?php

namespace App\Http\Requests\OrderLog;

use App\DbModels\Order;
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
            'assignedToUserId' => 'exists:users,id',
            'orderId' => 'required|exists:orders,id',
            'status' => 'required|in:' . implode(',', Order::getConstantsByPrefix('STATUS_')),
            'comments' => 'required|min: 5',
        ];
    }
}
