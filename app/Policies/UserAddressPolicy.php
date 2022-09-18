<?php

namespace App\Policies;

use App\DbModels\User;
use App\DbModels\UserAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserAddressPolicy
{
    use HandlesAuthorization;

    /**
     * Intercept checks
     *
     * @param User $currentUser
     * @return bool
     */
    public function before(User $currentUser)
    {
        if ($currentUser->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @return bool
     */
    public function list(User $currentUser)
    {
        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $userId
     * @return bool
     */
    public function store(User $currentUser, int $userId)
    {
        if($currentUser->id === $userId) {
            return true;
        };
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param UserAddress $userAddress
     * @return bool
     */
    public function show(User $currentUser,  UserAddress $userAddress)
    {
        if ($currentUser->id === $userAddress->userId) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param UserAddress $userAddress
     * @return bool
     */
    public function update(User $currentUser, UserAddress $userAddress)
    {
        return $currentUser->id === $userAddress->userId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function destroy(User $currentUser, User $user)
    {
        return false;
    }
}
