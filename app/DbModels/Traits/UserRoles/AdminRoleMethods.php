<?php


namespace App\DbModels\Traits\UserRoles;


trait AdminRoleMethods
{
    /**
     * is a super admin user
     *
     * @return boolean
     */
    public function isSuperAdminUserRole()
    {
        return $this->role->isSuperAdminRole();
    }

    /**
     * is a standard admin user
     *
     * @return boolean
     */
    public function isStandardAdminUserRole()
    {
        return $this->role->isStandardAdminRole();
    }

    /**
     * is a limited admin user
     *
     * @return boolean
     */
    public function isLimitedAdminUserRole()
    {
        return $this->role->isLimitedAdminRole();
    }

    /**
     * has any admin user role
     *
     * @return boolean
     */
    public function hasAdminUserRole()
    {
        return $this->role->hasAdminRole();
    }
}
