<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentItem extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const STATUS_REQUEST = 'request';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'refId',
        'paymentMethodId',
        'paymentId',
        'invoice',
        'paymentDate',
        'amount',
        'note',
        'status',
        'providerName',
        'vouchedId',
        'paymentProcessURL'
    ];

    /**
     * get the payment
     *
     * @return hasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'paymentId');
    }

    /**
     * get the payment method
     *
     * @return hasOne
     */
    public function paymentMethod()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'paymentMethodId');
    }

}
