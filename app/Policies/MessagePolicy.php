<?php

namespace App\Policies;

use App\DbModels\Message;
use App\DbModels\Module;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization, ValidateModules;

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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_MESSAGES)) {
            return false;
        }
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function list(User $currentUser, int $propertyId)
    {
        if ($currentUser->isUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param User $user
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
     * @param Message $message
     * @return bool
     */
    public function show(User $currentUser,  Message $message)
    {
        return in_array($currentUser->id, $message->messageUsers()->pluck('userId')->toArray());
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Message $message
     * @return bool
     */
    public function update(User $currentUser, Message $message)
    {
        return $currentUser->id === $message->id;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Message $message
     * @return bool
     */
    public function destroy(User $currentUser, Message $message)
    {
        return $currentUser->id === $message->id;
    }
}
