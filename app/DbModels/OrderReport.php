<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderReport extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const ORDER_REPORT_TYPES = [
        'Delivery Issue',
        'Product Issue',
        'Product Return Issue',
        'Product Refund Issue',
        'Payment Issue',
        'Order Cancel Issue',
        'Other Issue',
        'Balance Refund',
        'Bkash Refund',
        'Nagad Refund',
        'Card Refund',
        'Pricing Issues',
        'Shops Complaints',
        'Courier Issues',
        'Bank Payment Issue'
    ];
    
    CONST STATUS_SUBMITTED = 'submitted';
    CONST STATUS_ACTIVE = 'active';
    CONST STATUS_HOLDS = 'holds';
    CONST STATUS_SOLVED = 'solved';
    CONST STATUS_CLOSED = 'closed';
    CONST STATUS_REJECTED = 'rejected';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'updatedByUserId',
        'status',
        'type',
        'orderId',
        'comments',
    ];

    /**
     * get the order
     *
     * @return HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'orderId');
    }

    /**
     * get the order report comments
     *
     * @return HasMany
     */
    public function orderReportComments()
    {
        return $this->hasMany(OrderReportComment::class, 'orderReportId', 'id');
    }

    /**
     * is order report commentable
     *
     * @return bool
     */
    public function isCommentableOrderReport()
    {
        if (in_array($this->status, [self::STATUS_ACTIVE, self::STATUS_HOLDS, self::STATUS_SOLVED])) {
            return true;
        }

        return false;
    }

    /**
     * get all report types
     *
     */
    public static function getReportTypes() {
        return self::ORDER_REPORT_TYPES;
    }
}
