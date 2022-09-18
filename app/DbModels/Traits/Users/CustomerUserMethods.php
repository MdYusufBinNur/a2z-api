<?php


namespace App\DbModels\Traits\Users;

trait CustomerUserMethods
{
    /**
     * is a general type customer
     *
     * @return bool
     */
    public function isGeneralCustomer()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isGeneralCustomerUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a star type customer
     *
     * @return bool
     */
    public function isStarCustomer()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isStarCustomerUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a any kind of resident user
     *
     * @return bool
     */
    public function isCustomer()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->hasCustomerUserRole()) {
                return true;
            }
        }
        return false;
    }
}
