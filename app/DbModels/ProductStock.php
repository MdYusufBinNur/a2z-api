<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    CONST STATUS_AVAILABLE = 'available';
    CONST STATUS_STOCK_OUT = 'stock_out';

    CONST TYPE_UNIT = 'unit';
    CONST TYPE_KG = 'kg';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'updatedByUserId',
        'productId',
        'price',
        'oldPrice',
        'status',
        'type',
        'availableQuantity'
    ];
}
