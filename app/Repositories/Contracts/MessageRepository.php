<?php


namespace App\Repositories\Contracts;


interface MessageRepository extends BaseRepository
{
    /**
     * save a message
     *
     * @param array $data
     * @return mixed
     */
    public function saveMessage(array $data);

    /**
     * get user ids by group
     *
     * @param $data
     * @return array
     */
    public function getUsersByGroupNames($data);

}
