<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserProfile extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';
    const GENDER_OTHERS = 'others';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'userId', 'gender', 'address', 'occupation', 'homeTown', 'birthDate', 'interests'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birthDate' => 'datetime:h:i',
        'interests' => 'json'
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
