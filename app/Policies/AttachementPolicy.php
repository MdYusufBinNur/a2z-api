<?php

namespace App\Policies;

use App\DbModels\Attachment;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttachementPolicy
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
     * @param User $user
     * @return bool
     */
    public function store(User $currentUser)
    {
        return true;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Attachment $attachment
     * @return bool
     */
    public function show(User $currentUser,  Attachment $attachment)
    {
        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Attachment $attachment
     * @return bool
     */
    public function update(User $currentUser, Attachment $attachment)
    {
        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Attachment $attachment
     * @return bool
     */
    public function destroy(User $currentUser, Attachment $attachment)
    {
        return false;
    }
}
