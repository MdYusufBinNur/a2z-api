<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    protected $table = 'staffs';

    const LEVEL_STANDARD = 'standard_staff';
    const LEVEL_LIMITED = 'limited_staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'userId', 'userRoleId', 'contactEmail', 'phone', 'title', 'level'
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
    public function getStaffLabelAttribute()
    {
        return $this->title;
    }
}
