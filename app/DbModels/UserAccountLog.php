<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserAccountLog extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const TYPE_BALANCE = 'balance';
    const TYPE_HOLDING_BALANCE = 'holding-balance';
    const TYPE_GIFT_CARD = 'gift-card';
    const TYPE_CASHBACK = 'cashback';

    const METHOD_IN = 'in';
    const METHOD_OUT = 'out';

    const RESOURCE_TYPE_ORDER_CASHBACK = 'order-cashback';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'userAccountId',
        'type',
        'resourceId',
        'resourceType',
        'method',
        'amount',
        'reason',
        'date',
        'updatedByUserId'
    ];

    /**
     * get the user
     *
     * @return BelongsTo
     */
    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class, 'userAccountId', 'id');
    }
}
