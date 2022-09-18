<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelHelperFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use App\DbModels\Traits\Users\CommonUserMethods;
use App\DbModels\Traits\Users\AdminUserMethods;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, CommonModelHelperFeatures, CommonUuidFeatures;

    use AdminUserMethods, CommonUserMethods;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'locale', 'createdByUserId', 'isActive', 'lastLoginAt', 'notificationSeenAt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $castsROle = [
        'lastLoginAt' => 'datetime:Y-m-d h:i',
    ];

    /**
     * set default values
     *
     * @var array
     */
    protected $attributes = [
        'isActive' => 0
    ];

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * user and roles relationship
     *
     * @return HasMany
     */
    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'userId', 'id');
    }

    /**
     * user and admin user relationship
     *
     * @return HasOne
     */
    public function admin()
    {
        return $this->hasOne(Admin::class, 'userId');
    }

    /**
     * user and customer relationship
     *
     * @return HasOne
     */
    public function customer()
    {
        return $this->hasOne(Customer::class, 'userId', 'id');
    }

    /**
     * user and managers relationship
     *
     * @return HasOne
     */
    public function staff()
    {
        return $this->hasOne(Staff::class, 'userId', 'id');
    }

    /**
     * is a active user
     *
     * @return bool
     */
    public function isActive()
    {
        return (boolean) $this->isActive;
    }

    /**
     * get user's profile picture
     *
     * @return HasOne
     */
    public function profilePic()
    {
        return $this->hasOne(Attachment::class, 'resourceId', 'id')->where('type', Attachment::ATTACHMENT_TYPE_USER_PROFILE)->latest();
    }

    /**
     * get user's profile profile info
     *
     * @return HasOne
     */
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'userId', 'id');
    }

    /**
     * get user's profile profile info
     *
     * @return HasMany
     */
    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class, 'userId', 'id');
    }

    /**
     * get user's profile profile info
     *
     * @return HasOne
     */
    public function userNotificationSettings()
    {
        return $this->hasOne(UserNotificationSetting::class, 'userId', 'id');
    }

    /**
     * get userAccount
     *
     * @return HasOne
     */
    public function userAccount()
    {
        return $this->hasOne(UserAccount::class, 'userId', 'id');
    }

    /**
     * get userAccount
     *
     * @return HasOne
     */
    public function passwordResetPin()
    {
        return $this->hasOne(PasswordReset::class, 'userId', 'id')
            ->where('validTill', Carbon::today())
            ->latest();
    }


    /**
     * get all roles titles of a user
     *
     * @return array - of strings
     *
     */
    public function getRolesTitles()
    {
        $roles = [];
        foreach ($this->userRoles as $userRole) {
            $roles[] = $userRole->role->title;
        }
        return $roles;
    }

    /**
     * @draft
     * @param $userRoles
     * @return string
     */
    public function getUserLabel($userRoles)
    {
        $roleIds = $userRoles->pluck('roleId')->toArray();
        $label = '';

        foreach ($roleIds as $roleId) {
            if (in_array($roleId, [Role::ROLE_ADMIN_LIMITED['id'], Role::ROLE_ADMIN_STANDARD['id'], Role::ROLE_ADMIN_SUPER['id']])) {
               return 'Admin User';
            }
            if (in_array($roleId, [Role::ROLE_CUSTOMER_STAR['id'], Role::ROLE_CUSTOMER_GENERAL['id']])) {
                return 'Customer User';
            }
            if (in_array($roleId, [Role::ROLE_STAFF_STANDARD['id'], Role::ROLE_STAFF_LIMITED['id']])) {
                return 'Staff User';
            }
        }

        return $label;
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
