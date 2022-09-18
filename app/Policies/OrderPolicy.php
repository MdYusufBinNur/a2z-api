<?php

namespace App\Policies;

use App\DbModels\Order;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
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
        if (!empty($userId)) {
            return $currentUser->id == $userId;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int|null $userId
     * @return bool
     */
    public function store(User $currentUser, ?int $userId)
    {
        if (!empty($userId)) {
            return $currentUser->id == $userId;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Order $order
     * @return bool
     */
    public function show(User $currentUser, Order $order)
    {
        if (!empty($currentUser->id)) {
            return $currentUser->id == $order->createdByUserId;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Order $order
     * @return bool
     */
    public function update(User $currentUser,  Order $order)
    {
        return $currentUser->id == $order->createdByUserId;
    }
}
