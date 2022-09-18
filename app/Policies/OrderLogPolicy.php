<?php

namespace App\Policies;

use App\DbModels\OrderLog;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderLogPolicy
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
     * @param int|null $userId
     * @return bool
     */
    public function list(User $currentUser, ?int $userId)
    {
        if ($currentUser->id == $userId) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param OrderLog $orderLog
     * @return bool
     */
    public function show(User $currentUser, OrderLog $orderLog)
    {
        if ($currentUser->id == $orderLog->createdByUserId) {
            return true;
        }

        return false;
    }

}
