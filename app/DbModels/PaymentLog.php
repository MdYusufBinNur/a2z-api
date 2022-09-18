<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentLog extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'paymentId',
        'paymentTransactionId',
        'paymentMethod',
        'updatedByUserId',
        'cashReceivedById',
        'status',
        'event',
        'paid',
        'due',
        'advance',
        'note'
    ];


    /**
     * get the user
     *
     * @return HasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'paymentId');
    }

    /**
     * get the user
     *
     * @return HasOne
     */
    public function paymentTransaction()
    {
        return $this->hasOne(PaymentTransaction::class, 'id', 'paymentTransactionId');
    }

    /**
     * get the user
     *
     * @return HasOne
     */
    public function paymentMethod()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'paymentMethodId');
    }

    /**
     * get the user
     *
     * @return HasOne
     */
    public function updatedByUser()
    {
        return $this->hasOne(User::class, 'id', 'updatedByUserId');
    }

    /**
     * get the user
     *
     * @return HasOne
     */
    public function cashReceivedBy()
    {
        return $this->hasOne(User::class, 'id', 'cashReceivedById');
    }

}
