<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonUuidFeatures;
use App\DbModels\Traits\UserRoles\AdminRoleMethods;
use App\DbModels\Traits\UserRoles\CustomerRoleMethods;
use App\DbModels\Traits\UserRoles\StaffRoleMethods;
use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserRole extends Model
{
    use CommonModelFeatures, AdminRoleMethods, CustomerRoleMethods, StaffRoleMethods, CommonUuidFeatures;

    /**
     * Table name
     * @var string
     */
    protected $table = 'user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'roleId', 'userId', 'createdByUserId'
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
     * get the role of the user
     *
     * @return HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'roleId');
    }
}
