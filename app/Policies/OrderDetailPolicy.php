<?php

namespace App\Policies;

use App\DbModels\OrderDetail;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderDetailPolicy
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
     * @param OrderDetail $orderDetail
     * @return bool
     */
    public function show(User $currentUser, OrderDetail $orderDetail)
    {
        if ($currentUser->id == $orderDetail->createdByUserId) {
            return true;
        }

        return false;
    }

}
