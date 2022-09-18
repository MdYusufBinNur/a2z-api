<?php


namespace App\DbModels\Traits\UserRoles;


trait CustomerRoleMethods
{
    /**
     * is a owner type resident's user role
     *
     * @return boolean
     */
    public function isStarCustomerUserRole()
    {
        return $this->role->isStarCustomerRole();
    }

    /**
     * is a tenant type resident's user role
     *
     * @return boolean
     */
    public function isGeneralCustomerUserRole()
    {
        return $this->role->isGeneralCustomerRole();
    }


    /**
     * has any resident user role
     *
     * @return boolean
     */
    public function hasCustomerUserRole()
    {
        return $this->role->hasCustomerRole();
    }
}
