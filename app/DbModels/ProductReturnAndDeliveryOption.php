<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;

class ProductReturnAndDeliveryOption extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "createdByUserId",
        "updatedByUserId",
        "productId",
        "deliveryOptions",
        "returnOptions",
        "isFreeDeliveryAvailable",
        "isProductReturnable"
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isFreeDeliveryAvailable' => 'boolean',
        'isProductReturnable' => 'boolean'
    ];


    /**
     * get the Product
     */
    public function product()
    {
        return $this->hasOne(Product::class,'id','productId');
    }
}
