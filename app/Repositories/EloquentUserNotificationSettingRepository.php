<?php


namespace App\Repositories;


use App\Repositories\Contracts\UserNotificationSettingRepository;
use Illuminate\Support\Arr;

class EloquentUserNotificationSettingRepository extends EloquentBaseRepository implements UserNotificationSettingRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $loggedInUser = $this->getLoggedInUser();
        //todo need to move it into a method in User/UserRole model
        if ($loggedInUser->isAdmin()) {

        } else {
            $searchCriteria['userId'] = $this->getLoggedInUser()->id;
        }

        return parent::findBy($searchCriteria, $withTrashed);
    }


    /**
     * @inheritDoc
     */
    public function saveUserNotificationSettings(array $data)
    {
        $userNotificationSettings = [];
        foreach ($data['userNotificationSettings'] as $userNotificationSetting) {
            $searchCriteria = Arr::only($userNotificationSetting, ['userId', 'typeId']);
            $userNotificationSettings[] = $this->patch($searchCriteria, $userNotificationSetting);
        }

        return $userNotificationSettings;
    }

}
