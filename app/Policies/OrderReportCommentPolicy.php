<?php

namespace App\Policies;

use App\DbModels\OrderReportComment;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderReportCommentPolicy
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
     * @param OrderReportComment $orderReportComment
     * @return bool
     */
    public function show(User $currentUser, OrderReportComment $orderReportComment)
    {
        if ($currentUser->id == $orderReportComment->createdByUserId) {
            return true;
        }

        return false;
    }

}
