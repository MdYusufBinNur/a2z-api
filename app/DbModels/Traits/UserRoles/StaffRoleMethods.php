<?php


namespace App\DbModels\Traits\UserRoles;


trait StaffRoleMethods
{
    /**
     * is a standard staff user
     *
     * @return boolean
     */
    public function isStandardStaffUserRole()
    {
        return $this->role->isStandardStaffRole();
    }

    /**
     * is a limited staff user
     *
     * @return boolean
     */
    public function isLimitedStaffUserRole()
    {
        return $this->role->isLimitedStaffRole();
    }

    /**
     * has any staff user role
     *
     * @return boolean
     */
    public function hasStaffUserRole()
    {
        return $this->role->hasStaffRole();
    }
}
