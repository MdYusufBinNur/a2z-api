<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Voucher extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    CONST STATUS_ACTIVE = 'active';
    CONST STATUS_INACTIVE = 'inactive';
    CONST STATUS_HOLD = 'hold';
    CONST STATUS_CLAIMED = 'claimed';
    CONST STATUS_EXPIRED = 'expired';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createByUserId',
        'updatedByUserId',
        'toUserId',
        'status',
        'code',
        'expiredAt',
        'isClaimed',
        'claimedAt',
        'note',
    ];

    /**
     * get the user
     *
     * @return HasOne
     */
    public function toUser()
    {
        return $this->hasOne(User::class, 'id', 'toUserId');
    }
}
