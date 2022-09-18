<?php

namespace App\Policies;

use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductStockOutLogPolicy
{
    use HandlesAuthorization;

    /**
     * Intercept checks
     *
     * @param User $currentUser
     * @return bool
     */
    public function before(User $currentUser)
    {
        if ($currentUser->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @return bool
     */
    public function list(User $currentUser)
    {
        if ($currentUser->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @return bool
     */
    public function store(User $currentUser)
    {
        if ($currentUser->isStandardAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @return bool
     */
    public function show(User $currentUser)
    {
        if ($currentUser->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @return bool
     */
    public function update(User $currentUser)
    {
        if ($currentUser->isSuperAdmin()) {
            return true;
        }

        return false;
    }
}
