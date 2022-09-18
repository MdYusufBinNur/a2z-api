<?php


namespace App\Repositories\Contracts;


interface UserNotificationRepository extends BaseRepository
{
    /**
     * set user's notification read status
     *
     * @param array $data
     * @return mixed
     */
    public function setUserNotificationReadStatus(array $data);

    /**
     * count unread notification of a user
     *
     * @return mixed
     */
    public function countUnreadNotificationOfTheCurrentUser();

}
