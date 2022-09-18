<?php


namespace App\Repositories;


use App\DbModels\Message;
use App\DbModels\MessageUser;
use App\Repositories\Contracts\MessageUserRepository;
use Illuminate\Support\Facades\DB;

class EloquentMessageUserRepository extends EloquentBaseRepository implements MessageUserRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['mu.message' => 'message', 'mu.user' => 'user', 'message.property' => 'message.property', 'message.fromUser' => 'message.fromUser', 'message.posts' => 'message.messagePosts', 'message.attachments' => 'message.attachments'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function saveByMessage(Message $message) : array
    {
        DB::beginTransaction();

        // save in `sent` folder
        $this->save(['messageId' => $message->id, 'userId' => $message->fromUserId, 'isRead' => true, 'folder' => MessageUser::FOLDER_SENT]);

        //save in `inbox` folder
        if ($message->isGroupMessage) {
            $toUserIds = explode(',', $message->group);
        } else {
            $toUserIds = [$message->toUserId];
        }

        foreach ($toUserIds as $toUserId) {
            $this->save(['messageId' => $message->id, 'userId' => $toUserId, 'folder' => MessageUser::FOLDER_INBOX]);
        }

        DB::commit();

        return $toUserIds;
    }

    /**
     * bulk update read status of messages by a user
     *
     * @param array $data
     * @return \IteratorAggregate
     */
    public function bulkUpdateReadStatus(array $data) : \IteratorAggregate
    {
        return parent::updateIn('id', $data['messageUserIds'], ['isRead' => $data['isRead']]);
    }

    /**
     * bulk delete of messages by a user
     *
     * @param array $data
     * @return mixed
     */
    public function bulkDelete(array $data)
    {
        return $this->model->whereIn('id', $data['messageUserIds'])->delete();
    }

}
