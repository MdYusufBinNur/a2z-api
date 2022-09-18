<?php


namespace App\Repositories\Contracts;


interface UserProfileRepository extends BaseRepository
{
    /**
     * set user' profile
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function setUserProfile(array $data): \ArrayAccess;

}
