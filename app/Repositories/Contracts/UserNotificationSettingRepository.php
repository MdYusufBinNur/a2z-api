<?php


namespace App\Repositories\Contracts;


interface UserNotificationSettingRepository extends BaseRepository
{
    /**
     * save user notification settings
     *
     * @param array $data
     * @return mixed
     */
    public function saveUserNotificationSettings(array $data);

}
