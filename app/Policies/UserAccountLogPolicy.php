<?php

namespace App\Policies;

use App\DbModels\User;
use App\DbModels\UserAccountLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAccountLogPolicy
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
     * @param $userId
     * @return bool
     */
    public function list(User $currentUser, int $userId)
    {
        return $currentUser->id == $userId;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @return bool
     */
    public function store(User $currentUser)
    {
        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param UserAccountLog $userAccountLog
     * @return bool
     */
    public function show(User $currentUser,  UserAccountLog $userAccountLog)
    {
        if ($currentUser->id === $userAccountLog->createdByUser->id) {
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
        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @return bool
     */
    public function destroy(User $currentUser)
    {
        return false;
    }

}
