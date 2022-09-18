<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const TITLE_CASH = 'Cash';
    const TITLE_BKASH = 'bkash';
    const TITLE_NAGAD = 'Nagad';
    const TITLE_ROCKET = 'Rocket';
    const TITLE_CARD = 'Card';
    const TITLE_BANK = 'Bank';
    const TITLE_SSL_COMMERZ = 'SSLCommerz';
    const TITLE_AAMAR_PAY = 'AamarPay';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'updatedByUserId',
        'title',
        'link',
        'callbackUrl',
        'discount',
        'details',
        'isActive',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isActive' => 'boolean'
    ];


    /**
     * get all the icons of the payment method
     *
     * @return HasMany
     */
    public function icons()
    {
        return $this->hasMany(Attachment::class, 'resourceId', 'id')
            ->where('type', Attachment::ATTACHMENT_TYPE_PAYMENT_METHOD);
    }

    /**
     * get all the default payment_methods
     *
     */
    public static function defaultPaymentMethods() {
        return self::TITLE_AAMAR_PAY . ',' . self::TITLE_NAGAD;
    }
}
