<?php


namespace App\Repositories;


use App\DbModels\Attachment;
use App\DbModels\MessageUser;
use App\Events\MessagePost\MessagePostCreatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\MessagePostRepository;
use App\Repositories\Contracts\MessageUserRepository;
use Illuminate\Support\Facades\DB;

class EloquentMessagePostRepository extends EloquentBaseRepository implements MessagePostRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data['fromUserId'] = $this->getLoggedInUser()->id;
        $messagePost = parent::save($data);

        if (isset($data['attachmentIds'])) {
            $attachmentRepository = app(AttachmentRepository::class);

            foreach ($data['attachmentIds'] as $attachment) {
                $attachment = $attachmentRepository->findOne($attachment);
                if ($attachment instanceof Attachment) {
                    $attachmentRepository->updateResourceId($attachment, $messagePost->id);
                }
            }
            unset($data['attachmentIds']);
        }

        if (!isset($data['isFirstTime'])) {
            $messageUsers = $messagePost->messageUsers()->get();

            $messageUserRepository = app(MessageUserRepository::class);

            foreach ($messageUsers as $messageUser) {
                $messageUserData = [];

                if ($messageUser->userId != $this->getLoggedInUser()->id) {
                    $messageUserData['isRead'] = false;
                    if ($messageUser->folder == MessageUser::FOLDER_SENT) {
                        $messageUserData['folder'] = MessageUser::FOLDER_INBOX_SENT;
                    }
                }
                
                $messageUserRepository->update($messageUser, $messageUserData);
            }
        }

        DB::commit();

        event(new MessagePostCreatedEvent($messagePost, $this->generateEventOptionsForModel()));

        return $messagePost;
    }
}
