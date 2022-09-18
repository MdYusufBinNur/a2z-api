<?php


namespace App\Repositories;


use App\DbModels\Message;
use App\DbModels\Role;
use App\Events\Message\MessageCreatedEvent;
use App\Repositories\Contracts\MessagePostRepository;
use App\Repositories\Contracts\MessageRepository;
use App\Repositories\Contracts\MessageUserRepository;
use App\Repositories\Contracts\ResidentRepository;
use App\Repositories\Contracts\TowerRepository;
use App\Repositories\Contracts\UnitRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EloquentMessageRepository extends EloquentBaseRepository implements MessageRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['message.property' => 'property', 'message.fromUser' => 'fromUser', 'message.posts' => 'messagePosts', 'message.attachments' => 'attachments'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $message = parent::save($data);

        return $message;
    }

    /**
     * @inheritDoc
     */
    public function saveMessage(array $data)
    {
        $messageDetails = $this->getUsersByGroupNames($data);
        $userIds = $messageDetails['userIds'];
        $groupNames = $messageDetails['groupNames'];

        if ($userCount = count($userIds)) {
            $data['fromUserId'] = $this->getLoggedInUser()->id;
            if (!empty($groupNames) || $userCount > 1) {
                $data['isGroupMessage'] = true;
                $data['group'] = implode(',', $userIds);
                $data['groupNames'] = implode(',', $groupNames);
            } else {
                $data['toUserId'] = $userIds[0];
            }

            DB::beginTransaction();

            // save a row in messages table
            $message = $this->save($data);

            //save a message post
            $messagePostRepository = app(MessagePostRepository::class);
            $messagePostData = ['messageId' => $message->id, 'fromUserId' => $message->fromUserId, 'text' => $data['text'], 'isFirstTime' => true];
            if (isset($data['attachmentIds'])) {
                $messagePostData['attachmentIds'] = $data['attachmentIds'];
            }
            $messagePostRepository->save($messagePostData);

            // save all users
            $messageUserRepository = app(MessageUserRepository::class);
            $toUserIds = $messageUserRepository->saveByMessage($message);

            DB::commit();

            if ($message instanceof Message) {
                event(new MessageCreatedEvent($message, $this->generateEventOptionsForModel()));
            }

        }

        return $message ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getUsersByGroupNames($data)
    {
        $userIds = [];
        $groupNames = [];
        $groups = explode(",", $data['toUserIds']);
        $userRoleRepository = app(UserRoleRepository::class);
//        $residentRepository = app(ResidentRepository::class);
//        $unitRepository = app(UnitRepository::class);
//        $towerRepository = app(TowerRepository::class);

        foreach ($groups as $group) {

            if (is_numeric($group)) {

                //if only to a user
                $userIds[] = $group;
            } else {
                switch ($group) {

                    case Message::GROUP_ENTIRE_PROPERTY:
                        $userIds[] = $userRoleRepository->getUserIdsOfEntireProperty($data['propertyId']);
                        $groupNames[] = Str::title(str_replace('_', ' ', Message::GROUP_ENTIRE_PROPERTY));
                        break;
                    case Message::GROUP_ALL_RESIDENTS:
                        $userIds[] = $userRoleRepository->getUserIdsOfThePropertyResidents($data['propertyId']);
                        $groupNames[] = Str::title(str_replace('_', ' ', Message::GROUP_ALL_RESIDENTS));
                        break;
                    case Message::GROUP_ALL_STAFFS:
                        $userIds[] = $userRoleRepository->getUserIdsOfThePropertyStaffs($data['propertyId']);
                        $groupNames[] = Str::title(str_replace('_', ' ', Message::GROUP_ALL_STAFFS));
                        break;
                    case Message::GROUP_ALL_TENANTS:
                        $userIds[] = $userRoleRepository->getUserIdsByRoleId($data['propertyId'], Role::ROLE_RESIDENT_TENANT['id']);
                        $groupNames[] = Str::title(str_replace('_', ' ', Message::GROUP_ALL_TENANTS));
                        break;
                    case Message::GROUP_ALL_OWNERS:
                        $userIds[] = $userRoleRepository->getUserIdsByRoleId($data['propertyId'], Role::ROLE_RESIDENT_OWNER['id']);
                        $groupNames[] = Str::title(str_replace('_', ' ', Message::GROUP_ALL_OWNERS));
                        break;
                }
            }
        }
        return [
            'userIds' => array_unique(Arr::flatten($userIds)),
            'groupNames' => array_unique(Arr::flatten($groupNames)),
        ];
    }
}
