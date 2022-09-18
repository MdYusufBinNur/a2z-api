<?php

namespace App\Policies;

use App\DbModels\RatingAndReview;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RatingAndReviewPolicy
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
     * @param RatingAndReview $productReview
     * @return bool
     */
    public function show(User $currentUser, RatingAndReview $productReview)
    {
        if ($currentUser->id == $productReview->createdByUserId) {
            return true;
        }

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
        if ($currentUser->isStandardAdmin()) {
            return true;
        }

        return false;
    }
}
