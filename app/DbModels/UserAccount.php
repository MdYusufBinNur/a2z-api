<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserAccount extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const STATUS_ACTIVE = 'active';
    const STATUS_BANNED = 'banned';
    const STATUS_HOLD = 'hold';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'userId',
        'balanceAmount',
        'holdingAmount',
        'giftCardAmount',
        'cashbackAmount',
        'status',
        'note',
        'currency',
        'updatedByUserId'

    ];

    /**
     * get the user
     *
     * @return HasMany
     */
    public function userAccountLogs()
    {
        return $this->hasMany(UserAccountLog::class, 'userAccountId', 'id');
    }

    /**
     * get the user
     *
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
