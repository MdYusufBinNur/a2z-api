<?php


namespace App\DbModels\Traits\Users;


trait AdminUserMethods
{
    /**
     * is a super admin user
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isSuperAdminUserRole()) {
                return true;
            }
        }

        return false;
    }

    /**
     * is a standard admin user
     *
     * @return bool
     */
    public function isStandardAdmin()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isStandardAdminUserRole()) {
                return true;
            }
        }

        return false;
    }

    /**
     * is a limited admin user
     *
     * @return bool
     */
    public function isLimitedAdmin()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isLimitedAdminUserRole()) {
                return true;
            }
        }

        return false;
    }

    /**
     * is a any kind of admin user
     *
     * @return bool
     */
    public function isAdmin()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->hasAdminUserRole()) {
                return true;
            }
        }

        return false;
    }
}
