<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PasswordReset extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const TYPE_SET_PASSWORD_BY_PIN = 'verify';
    const TYPE_RESET_PASSWORD_BY_PIN = 'forgot_password';
    const TYPE_RESEND_PIN = 'resend_pin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 'pin', 'type', 'validTill'
    ];

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
