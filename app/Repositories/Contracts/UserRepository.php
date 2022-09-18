<?php

namespace App\Repositories\Contracts;

interface UserRepository extends BaseRepository
{
    /**
     * update a user
     *
     * @param \ArrayAccess $model
     * @param array $data
     * @return \ArrayAccess
     */
    public function updateUser(\ArrayAccess $model, array $data): \ArrayAccess;

    /**
     * find user by email or phone
     *
     * @param mixed $emailOrPhone
     * @return mixed
     */
    public function findUserByEmailPhone($emailOrPhone);

    /**
     * get profile pic of a user
     *
     * @param int $userId
     * @return mixed
     */
    public function getProfilePicByUserId($userId, $size = 'medium');
}
