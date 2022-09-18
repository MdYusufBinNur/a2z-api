<?php


namespace App\DbModels\Traits\Users;

trait StaffUserMethods
{
    /**
     * is a standard staff user
     *
     * @return bool
     */
    public function isStandardStaff()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isStandardStaffUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a limited staff user
     *
     * @return bool
     */
    public function isLimitedStaff()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isLimitedStaffUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a any kind of staff user
     *
     * @return bool
     */
    public function isStaff()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->hasStaffUserRole()) {
                return true;
            }
        }
        return false;
    }
}
