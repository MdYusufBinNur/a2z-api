<?php

namespace App\Http\Requests\ProductStockOutLog;

use App\DbModels\ProductStockOutLog;
use App\Http\Requests\Request;
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
            'createdByUserId' => 'exist:users,id',
            'productId' => 'exist:products,id',
            'resourceId' => 'exist:resources,id',
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
