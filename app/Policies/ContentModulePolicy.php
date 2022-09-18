<?php

namespace App\Policies;

use App\DbModels\Admin;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentModulePolicy
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
        if ($currentUser->isStandardAdmin()) {
            return true;
        }

        return false;
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
            if ($level == Admin::LEVEL_LIMITED) {
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
        return $this->adminBasicPermission($currentUser, $admin);
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
        return $this->adminBasicPermission($currentUser, $admin);
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
        return $this->adminBasicPermission($currentUser, $admin);
    }

    /**
     * To prevent duplicity
     *
     * admin basic permission
     *
     * @param User $currentUser
     * @param Admin $admin
     * @return bool
     */
    private function adminBasicPermission(User $currentUser, Admin $admin)
    {
        $adminUser = $admin->user;
        if (!$adminUser instanceof User) {
            return false;
        }

        // if it's a super admin return false
        if ($adminUser->isSuperAdmin()) {
            return false;
        }


        // if current user is standard admin & want to see limited admin then return true
        if ($admin->user->isLimitedAdmin() && $currentUser->isStandardAdmin()) {
            return true;
        }

        return $currentUser->id === $admin->user->id;
    }
}
