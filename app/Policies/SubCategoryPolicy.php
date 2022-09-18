<?php

namespace App\Policies;

use App\DbModels\Admin;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubCategoryPolicy
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
        return true;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param string $level
     * @return bool
     */
    public function store(User $currentUser, string $level)
    {
        if ($currentUser->isStandardAdmin()) {
            if ($level == Admin::LEVEL_STANDARD) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Admin $admin
     * @return bool
     */
    public function show(User $currentUser,  Admin $admin)
    {
        return true;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Admin $admin
     * @return bool
     */
    public function update(User $currentUser, Admin $admin)
    {
        if ($currentUser->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Admin $admin
     * @return bool
     */
    public function destroy(User $currentUser, Admin $admin)
    {
        return false;
    }
}
