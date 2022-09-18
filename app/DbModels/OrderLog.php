<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderLog extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    CONST STATUS_ALL = 'all';
    CONST STATUS_PENDING = 'pending';
    CONST STATUS_CONFIRMED = 'confirmed';
    CONST STATUS_PROCESSING = 'processing';
    CONST STATUS_PICKED = 'picked';
    CONST STATUS_SHIPPED = 'shipped';
    CONST STATUS_DELIVERED = 'delivered';
    CONST STATUS_CANCELLED = 'cancelled';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createByUserId',
        'assignedToUserId',
        'orderId',
        'status',
        'comments',
    ];

    /**
     * get the user roles
     *
     * @return HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'orderId');
    }
}
