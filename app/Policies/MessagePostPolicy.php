<?php

namespace App\Policies;

use App\DbModels\Message;
use App\DbModels\MessagePost;
use App\DbModels\Module;
use App\DbModels\User;
use App\Repositories\Contracts\MessageRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePostPolicy
{
    use HandlesAuthorization, ValidateModules;

    /**
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     * MessagePostPolicy constructor.
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
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
     * @param int $messageId
     * @return bool
     */
    public function list(User $currentUser, int $messageId)
    {
        $message = $this->messageRepository->findOne($messageId);

        if ($message instanceof Message) {
            return $message->messageCanBeAccessedByTheUser($currentUser->id);
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $messageId
     * @return bool
     */
    public function store(User $currentUser, int $messageId)
    {
        $message = $this->messageRepository->findOne($messageId);

        if ($message instanceof Message) {
            return $message->messageCanBeAccessedByTheUser($currentUser->id);
        }

        return true;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param MessagePost $messagePost
     * @return bool
     */
    public function show(User $currentUser,  MessagePost $messagePost)
    {
        return $messagePost->message->messageCanBeAccessedByTheUser($currentUser->id);
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param MessagePost $messagePost
     * @return bool
     */
    public function update(User $currentUser, MessagePost $messagePost)
    {
        return $currentUser->id === $messagePost->createdByUserId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param MessagePost $messagePost
     * @return bool
     */
    public function destroy(User $currentUser, MessagePost $messagePost)
    {
        return $currentUser->id === $messagePost->createdByUserId;
    }
}
