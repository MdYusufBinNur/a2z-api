<?php

namespace App\Policies;

use App\DbModels\RefundRequest;
use App\DbModels\RefundRequestLog;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RefundRequestLogPolicy
{
    use HandlesAuthorization;
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
     * @param RefundRequestLog $refundRequestLog
     * @return bool
     */
    public function show(User $currentUser, RefundRequestLog $refundRequestLog)
    {
        if ($currentUser->id === $refundRequestLog->createdByUserId) {
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

}
