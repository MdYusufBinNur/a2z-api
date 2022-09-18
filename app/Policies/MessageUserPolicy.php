<?php

namespace App\Policies;

use App\DbModels\MessageUser;
use App\DbModels\Module;
use App\DbModels\User;
use App\Repositories\Contracts\MessageRepository;
use App\Repositories\Contracts\MessageUserRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessageUserPolicy
{
    use HandlesAuthorization, ValidateModules;

    /**
     * @var MessageUserRepository
     */
    private $messageUserRepository;

    /**
     * MessagePostPolicy constructor.
     * @param MessageUserRepository $messageRepository
     */
    public function __construct(MessageUserRepository $messageRepository)
    {
        $this->messageUserRepository = $messageRepository;
    }

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
     * @param int $userId
     * @return bool
     */
    public function list(User $currentUser, int $userId)
    {
        return $currentUser->id == $userId;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param MessageUser $messageUser
     * @return bool
     */
    public function show(User $currentUser,  MessageUser $messageUser)
    {
        return $currentUser->id === $messageUser->userId;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param MessageUser $messageUser
     * @return bool
     */
    public function update(User $currentUser, MessageUser $messageUser)
    {
        return $currentUser->id === $messageUser->userId;
    }

    /**
     * Determine if a given user can bulk-update
     *
     * @param User $currentUser
     * @param mixed $messageUserIds
     * @return bool
     */
    public function bulkUpdate(User $currentUser, $messageUserIds)
    {
        $messageUsers = $this->messageUserRepository->getModel()->whereIn('id', $messageUserIds)->get();

        foreach ($messageUsers as $messageUser) {
            if ($currentUser->id !== $messageUser->userId) {
                return false;
            }
        }

        return true;
    }

    /**
     * Determine if a given user can bulk-delete
     *
     * @param User $currentUser
     * @param mixed $messageUserIds
     * @return bool
     */
    public function bulkDelete(User $currentUser, $messageUserIds)
    {
        $messageUsers = $this->messageUserRepository->getModel()->whereIn('id', $messageUserIds)->get();

        foreach ($messageUsers as $messageUser) {
            if ($currentUser->id !== $messageUser->userId) {
                return false;
            }
        }

        return true;
    }
}
