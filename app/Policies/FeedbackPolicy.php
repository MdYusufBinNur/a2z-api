<?php

namespace App\Policies;

use App\DbModels\Feedback;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedbackPolicy
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
        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId)
    {
        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Feedback $feedback
     * @return bool
     */
    public function show(User $currentUser,  Fdi $fdi)
    {
        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Feedback $feedback
     * @return bool
     */
    public function update(User $currentUser, Fdi $fdi)
    {
        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Feedback $feedback
     * @return bool
     */
    public function destroy(User $currentUser, Feedback $feedback)
    {
        return false;
    }
}
