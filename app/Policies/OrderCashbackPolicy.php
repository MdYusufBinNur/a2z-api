<?php

namespace App\Policies;

use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderCashbackPolicy
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
        if ($currentUser->isStandardAdmin()) {
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
        if ($currentUser->id === $userId) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param RefundRequest $refundRequest
     * @return bool
     */
    public function show(User $currentUser, RefundRequest $refundRequest)
    {
        if ($currentUser->id === $refundRequest->createdByUserId) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param RefundRequest $refundRequest
     * @return bool
     */
    public function update(User $currentUser, RefundRequest $refundRequest)
    {
        if ($currentUser->id === $refundRequest->createdByUserId) {
            return true;
        }

        return false;
    }

}
