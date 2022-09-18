<?php

namespace App\Policies;

use App\DbModels\User;
use App\DbModels\UserNotification;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserNotificationPolicy
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
     * @param int $userId
     * @return bool
     */
    public function list(User $currentUser, int $userId)
    {
        return $currentUser->id == $userId;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param UserNotification $userNotification
     * @return bool
     */
    public function show(User $currentUser,  UserNotification $userNotification)
    {
        return $currentUser->id == $userNotification->toUserId;
    }
}
