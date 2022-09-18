<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RefundRequest extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    CONST STATUS_REQUEST = 'request';
    CONST STATUS_ACCEPTED = 'accepted';
    CONST STATUS_PENDING = 'pending';
    CONST STATUS_HOLD = 'hold';
    CONST STATUS_DECLINED = 'declined';
    CONST STATUS_REFUNDED = 'refunded';

    const PAYMENT_METHOD_DEFAULT = 'bkash';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'updatedByUserId',
        'orderId',
        'paymentId',
        'amount',
        'requestPaymentMethod',
        'status',
        'comment',
        'assignedToUserId'
    ];


    /**
     * get the refundRequestLogs
     *
     * @return HasMany
     */
    public function refundRequestLogs()
    {
        return $this->hasMany(RefundRequestLog::class, 'refundRequestId', 'id');
    }

    /**
     * get the assignedToUser
     *
     * @return HasOne
     */
    public function assignedToUser()
    {
        return $this->hasOne(User::class, 'id', 'assignedToUserId');
    }

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
     * get the payment
     *
     * @return HasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'paymentId');
    }

    /**
     * get the paymentItems
     *
     * @return HasManyThrough
     */
    public function paymentLogs()
    {
        return $this->payment->paymentLogs();
    }

    /**
     * get the updatedByUser
     *
     * @return HasOne
     */
    public function updatedByUser()
    {
        return $this->hasOne(User::class, 'id', 'updatedByUserId');
    }
}
