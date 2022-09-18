<?php

namespace App\Policies;

use App\DbModels\OrderReport;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderReportPolicy
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
     * @param int|null $userId
     * @return bool
     */
    public function store(User $currentUser, ?int $userId)
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
     * @param OrderReport $orderReport
     * @return bool
     */
    public function show(User $currentUser, OrderReport $orderReport)
    {
        if ($currentUser->id == $orderReport->createdByUserId) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param OrderReport $orderReport
     * @return bool
     */
    public function update(User $currentUser, OrderReport $orderReport)
    {
        if ($currentUser->id == $orderReport->createdByUserId) {
            return true;
        }

        return false;
    }

}
