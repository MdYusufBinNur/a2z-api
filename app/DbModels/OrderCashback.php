<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class OrderCashback extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'userAccountId',
        'orderDetailId',
        'status',
        'cashbackAmount',
        'date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'userAccountId' => 'integer',
        'orderDetailId' => 'integer',
        'cashbackAmount' => 'float',
    ];

    /**
     * get the user roles
     *
     * @return BelongsTo
     */
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'orderDetailId', 'id');
    }

    /**
     * get the user roles
     *
     * @return BelongsTo
     */
    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class, 'userAccountId', 'id');
    }
}
