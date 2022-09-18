<?php

namespace App\Policies;

use App\DbModels\Staff;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
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
        if ($currentUser->isAdmin()) {
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
        if ($currentUser->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Staff $staff
     * @return bool
     */
    public function show(User $currentUser, Staff $staff)
    {
        if ($currentUser->id === $staff->userId) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Staff $staff
     * @return bool
     */
    public function update(User $currentUser, Staff $staff)
    {
        $user = $staff->user;

        if ($user instanceof User) {
            return $currentUser->id === $user->id;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Staff $staff
     * @return bool
     */
    public function destroy(User $currentUser, Staff $staff)
    {
        $user = $staff->user;
        if ($user instanceof User) {
            if ($currentUser->isAdmin()) {
                return true;
            }
        }

        return false;
    }
}
