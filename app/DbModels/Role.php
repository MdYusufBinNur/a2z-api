<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\CommonUuidFeatures;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use CommonModelFeatures, CommonUuidFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'type', 'title'
    ];

    // N.B. setting `id` statically for quicker insert where called
    const ROLE_ADMIN_SUPER = ['id' => 1, 'type' => 'admin', 'title' => 'super_admin'];
    const ROLE_ADMIN_STANDARD = ['id' => 2, 'type' => 'admin', 'title' => 'standard_admin'];
    const ROLE_ADMIN_LIMITED = ['id' => 3, 'type' => 'admin', 'title' => 'limited_admin'];

    const ROLE_STAFF_STANDARD = ['id' => 4, 'type' => 'staff', 'title' => 'standard_staff'];
    const ROLE_STAFF_LIMITED = ['id' => 5, 'type' => 'staff', 'title' => 'limited_staff'];

    const ROLE_CUSTOMER_STAR = ['id' => 6, 'type' => 'customer', 'title' => 'star_customer'];
    const ROLE_CUSTOMER_GENERAL = ['id' => 7, 'type' => 'customer', 'title' => 'general_customer'];

    const ROLE_VENDOR_STANDARD = ['id' => 8, 'type' => 'vendor', 'title' => 'standard_vendor'];
    const ROLE_VENDOR_LIMITED = ['id' => 9, 'type' => 'vendor', 'title' => 'limited_vendor'];

    /**
     * is a super admin role
     *
     * @return bool
     */
    public function isSuperAdminRole()
    {
        return $this->title === self::ROLE_ADMIN_SUPER['title'];
    }

    /**
     * is a standard admin role
     *
     * @return bool
     */
    public function isStandardAdminRole()
    {
        return $this->title === self::ROLE_ADMIN_STANDARD['title'];
    }

    /**
     * is a limited admin role
     *
     * @return bool
     */
    public function isLimitedAdminRole()
    {
        return $this->title === self::ROLE_ADMIN_LIMITED['title'];
    }


    /**
     * has any admin role
     *
     * @return bool
     */
    public function hasAdminRole()
    {
        return in_array($this->title, [self::ROLE_ADMIN_SUPER['title'], self::ROLE_ADMIN_STANDARD['title'], self::ROLE_ADMIN_LIMITED['title']]);
    }

    /**
     * is a standard staff role
     *
     * @return bool
     */
    public function isStandardStaffRole()
    {
        return $this->title === self::ROLE_STAFF_STANDARD['title'];
    }

    /**
     * is a limited staff role
     *
     * @return bool
     */
    public function isLimitedStaffRole()
    {
        return $this->title === self::ROLE_STAFF_LIMITED['title'];
    }


    /**
     * has any staff role
     *
     * @return bool
     */
    public function hasStaffRole()
    {
        return in_array($this->title, [self::ROLE_STAFF_STANDARD['title'], self::ROLE_STAFF_LIMITED['title']]);
    }

    /**
     * is a star customer role
     *
     * @return bool
     */
    public function isStarCustomerRole()
    {
        return $this->title === self::ROLE_CUSTOMER_STAR['title'];
    }

    /**
     * is a general customer role
     *
     * @return bool
     */
    public function isGeneralCustomerRole()
    {
        return $this->title === self::ROLE_CUSTOMER_GENERAL['title'];
    }

    /**
     * has any customer role
     *
     * @return bool
     */
    public function hasCustomerRole()
    {
        return in_array($this->title, [self::ROLE_CUSTOMER_GENERAL['title'], self::ROLE_CUSTOMER_STAR['title']]);
    }

    /**
     * is a vendor standard role
     *
     * @return bool
     */
    public function isStandardVendorRole()
    {
        return $this->title === self::ROLE_VENDOR_LIMITED['title'];
    }

    /**
     * is a vendor limited role
     *
     * @return bool
     */
    public function isLimitedVendorRole()
    {
        return $this->title === self::ROLE_VENDOR_LIMITED['title'];
    }

    /**
     * has any vendor role
     *
     * @return bool
     */
    public function hasVendorRole()
    {
        return in_array($this->title, [self::ROLE_VENDOR_LIMITED['title'], self::ROLE_VENDOR_STANDARD['title']]);
    }
}
