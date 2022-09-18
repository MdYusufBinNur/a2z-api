<?php

namespace App\Http\Requests\ProductStockOutLog;

use App\DbModels\ProductStockOutLog;
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
            'createdByUserId' => 'required|exist:users,id',
            'productId' => 'required|exist:products,id',
            'resourceId' => 'required|exist:resources,id',
            'resourceItem' => '',
            'startingQuantity' => '',
            'availableQuantity' => '',
            'decreaseQuantity' => '',
            'note' => '',
            'amount' => '',
            'date' => '',
            'status' => 'in:' . implode(',', ProductStockOutLog::getConstantsByPrefix('STATUS_')),
        ];
    }
}
