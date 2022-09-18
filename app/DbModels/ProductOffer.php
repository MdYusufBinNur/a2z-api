<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductOffer extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const TYPE_FLAT = 'flat';
    const TYPE_PERCENTAGE = 'percentage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "createdByUserId",
        "updatedByUserId",
        "productId",
        "vendorId",
        "brandId",
        "campaignId",
        "isActive",
        'startDate',
        'startTime',
        'endDate',
        'endTime',
        "cashback",
        "discount",
        "cashbackType",
        "discountType",
        "title",
        "availableQuantity"
    ];

    /**
     * get the Vendor
     *
     * @return HasOne
     */
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendorId');
    }

    /**
     * get the Product
     */
    public function product()
    {
        return $this->hasOne(Product::class,'id','productId');
    }

    /**
     * get the Brand
     */
    public function brand()
    {
        return $this->hasOne(Brand::class,'id','brandId');
    }

    /**
     * get the Campaign
     */
    public function campaign()
    {
        return $this->hasOne(Campaign::class,'id','campaignId');
    }

}
