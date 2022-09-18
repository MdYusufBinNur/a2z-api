<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;

class ProductStockOutLog extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    CONST STATUS_STOCK_ON_HAND = "stock_on_hand";
    CONST STATUS_STOCK_FAULT_BACK = "stock_fault_back";
    CONST STATUS_STOCK_DELIVERED = "stock_delivered";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createByUserId', 'productId', 'resourceId', 'resourceItem', 'startingQuantity',
        'availableQuantity', 'decreaseQuantity', 'note', 'amount','date','status'
    ];

}
