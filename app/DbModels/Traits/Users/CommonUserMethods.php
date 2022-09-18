<?php


namespace App\DbModels\Traits\Users;


trait CommonUserMethods
{
    /**
     * has any role upto standard admin user
     *
     * @return bool
     */
    public function upToStandardAdmin()
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->isStandardAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * has any role upto limited admin user
     *
     * @return bool
     */
    public function uptoLimitedAdmin()
    {
        if ($this->upToStandardAdmin()) {
            return true;
        }

        return false;
    }
}
