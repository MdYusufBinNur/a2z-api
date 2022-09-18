<?php

namespace App\Policies;

use App\DbModels\MessageTemplate;
use App\DbModels\Module;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessageTemplatePolicy
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
     * @param MessageTemplate $messageTemplate
     * @return bool
     */
    public function show(User $currentUser,  MessageTemplate $messageTemplate)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param MessageTemplate $messageTemplate
     * @return bool
     */
    public function update(User $currentUser, MessageTemplate $messageTemplate)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param MessageTemplate $messageTemplate
     * @return bool
     */
    public function destroy(User $currentUser, MessageTemplate $messageTemplate)
    {
        return false;
    }
}
