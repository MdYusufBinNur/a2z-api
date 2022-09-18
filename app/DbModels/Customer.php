<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    //FYI, it has to be matched with its corresponding user role
    const LEVEL_STAR = 'star_customer';
    const LEVEL_GENERAL = 'general_customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'createdByUserId',
        'name',
        "userId",
        "userRoleId",
        'email',
        'phone',
        'level',
        'title',
        'isAgreeTC'
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

    /**
     * get the user's role
     *
     * @return HasOne
     */
    public function userRole()
    {
        return $this->hasOne(UserRole::class, 'id', 'userRoleId');
    }

    /**
     * get the user roles
     *
     * @return Hasmany
     */
    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'userId', 'userId');
    }

    /**
     * get label
     *
     * @return mixed
     */
    public function setLabelAttribute()
    {
        $this->attributes['level'] = self::LEVEL_GENERAL;
    }

    /**
     * get label
     *
     * @param $name
     * @return mixed
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = ucfirst($name);
    }
}
