<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentTransaction extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    const STATUS_REJECTED = 'rejected';
    const STATUS_PENDING = 'pending';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paymentId',
        'providerName',
        'providerId',
        'status',
        'sourceURL',
        'paymentProcessURL',
        'rawData'
    ];


    /**
     * user and admin user relationship
     *
     * @return HasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'paymentId');
    }
}
