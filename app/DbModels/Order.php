<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use phpDocumentor\Reflection\Types\Self_;

class Order extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const STATUS_ALL = 'all';
    const STATUS_REQUEST = 'request';
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_PROCESSING = 'processing';
    const STATUS_PICKED = 'picked';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    const CURRENT_INVOICE_PREFIX = 'DB';
    const ALLOWED_DAYS_TO_COMPLETE_PAYMENT = 7;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'assignedToUserId',
        'status',
        'invoice',
        'amount',
        'discount',
        'address',
        'phone',
        'paymentStatus',
        'voucherId',
        'orderTypeId',
        'campaignId',
        'vendorId',
        'acceptTAC',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'acceptTAC' => 'boolean'
    ];

    /**
     * is the model change/update able
     *
     * @return bool
     */
    public function isPayable()
    {
        if (($this->created_at->diffInDays(Carbon::now()) <= self::ALLOWED_DAYS_TO_COMPLETE_PAYMENT)
            && in_array($this->paymentStatus, [Payment::STATUS_UNPAID, Payment::STATUS_PARTIAL])
            && in_array($this->status, [self::STATUS_CONFIRMED, self::STATUS_PENDING])) {
            return true;
        }

        return false;
    }

    /**
     * is the model change/update able
     *
     * @return bool
     */
    public function isRefundable()
    {
        if (in_array($this->paymentStatus, [Payment::STATUS_PAID, Payment::STATUS_PARTIAL])
            && in_array($this->status, [self::STATUS_PROCESSING, self::STATUS_PENDING])) {
            return true;
        }

        return false;
    }

    /**
     * is the order cancel able
     *
     * @return bool
     */
    public function isCancelable()
    {
        if (in_array($this->paymentStatus, [Payment::STATUS_UNPAID])
            && in_array($this->status, [self::STATUS_REQUEST, self::STATUS_PENDING, self::STATUS_PROCESSING, self::STATUS_CONFIRMED])) {
            return true;
        }

        return false;
    }

    /**
     * can leave a review for this order
     *
     * @return bool
     */
    public function canLeaveReview()
    {
        if (in_array($this->status, [self::STATUS_DELIVERED])) {
            return true;
        }

        return false;
    }

    /**
     * can leave a review for this order
     *
     * @return bool
     */
    public function canMarkAsDelivered()
    {
        if (in_array($this->paymentStatus, [Payment::STATUS_PAID])
            && in_array($this->status, [self::STATUS_PICKED, self::STATUS_SHIPPED])
        ) {
            return true;
        }

        return false;
    }

    /**
     * get the orderDetails
     *
     * @return Hasmany
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'orderId', 'id');
    }

    /**
     * get the vendor
     *
     * @return HasOne
     */
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendorId');
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
     * get the orderType
     *
     * @return HasOne
     */
    public function orderType()
    {
        return $this->hasOne(OrderType::class, 'id', 'orderTypeId');
    }

    /**
     * get the orderLogs
     *
     * @return HasMany
     */
    public function orderLogs()
    {
        return $this->hasMany(OrderLog::class, 'orderId', 'id')->orderBy('id', 'DESC');
    }

    /**
     * get the orderReports
     *
     * @return HasMany
     */
    public function orderReports()
    {
        return $this->hasMany(OrderReport::class, 'orderId', 'id');
    }

    /**
     * get the campaign
     *
     * @return hasOne
     */
    public function campaign()
    {
        return $this->hasOne(Campaign::class, 'id', 'camapignId');
    }

    /**
     * get the campaign
     *
     * @return hasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'orderId', 'id');
    }

    //generating auto invoice number
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->invoice = self::CURRENT_INVOICE_PREFIX . $model->vendorId .'V' .date("dHis") . mt_rand(100,999);
        });
    }
}
