<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;

class RatingAndReview extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const TYPE_PRODUCT = 'product';
    const TYPE_VENDOR = 'vendor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'productId',
        'vendorId',
        'rating',
        'type',
        'comments'
    ];
}
