<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderDetail extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const CASHBACK_STATUS_NONE = 'none';
    const CASHBACK_STATUS_PENDING = 'pending';
    const CASHBACK_STATUS_ADDED = 'added';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orderId',
        'invoice',
        'createdByUserId',
        'productOfferId',
        'productId',
        'productPrice',
        'productQuantity',
        'size',
        'color',
        'comment',
        'cashbackStatus',
    ];

    /**
     * get the user roles
     *
     * @return HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'productId');
    }

    /**
     * get the user roles
     *
     * @return HasOne
     */
    public function productOffer()
    {
        return $this->hasOne(ProductOffer::class, 'id', 'productOfferId');
    }

    /**
     * get the user roles
     *
     * @return BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId', 'id');
    }

}
