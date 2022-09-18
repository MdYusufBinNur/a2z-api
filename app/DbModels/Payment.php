<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Payment extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const STATUS_UNPAID = 'unpaid';
    const STATUS_PARTIAL = 'partial';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_PAID = 'paid';
    const STATUS_REFUND_REQUEST = 'refund-request';
    const STATUS_REFUNDED = 'refunded';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'orderId',
        'invoice',
        'amount',
        'paid',
        'due',
        'advance',
        'dueDate',
        'status',
        'allowedPaymentMethods',
        'updatedByUserId'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dueDate' => 'datetime:Y-m-d h:i',
    ];


    /**
     * allowedPaymentMethods getter
     */
    public function getAcceptPaymentMethodsAttribute()

    {
        return isset($this->attributes['allowedPaymentMethods']) ? explode(",", $this->attributes['allowedPaymentMethods']) : [];
    }

    /**
     * check if payment's due date passed
     *
     * @return bool
     */
    public function hasDueDatePassed()
    {
        return $this->attributes['dueDate'] <= Carbon::today() && $this->paid === (float) 0;
    }

    /**
     * is the model change/update able
     *
     * @return bool
     */
    public function isUpdateAble()
    {
        if (in_array($this->attributes['status'], [self::STATUS_UNPAID, self::STATUS_PARTIAL])) {
            return true;
        }

        return false;
    }

    /**
     * is the model change/update able
     *
     * @return void
     */
    public function setDueDateAttributes()
    {
        $this->attributes['dueDate'] = Carbon::now()->addDays(3);
    }

    /**
     * get the payment
     *
     * @return hasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'orderId');
    }


    /**
     * get the paymentItems
     *
     * @return hasMany
     */
    public function paymentLogs()
    {
        return $this->hasMany(PaymentLog::class, 'paymentId', 'id');
    }
}
