<?php

namespace App\Policies;

use App\DbModels\Customer;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
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
        if ($currentUser->isAdmin()) {
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
        if ($currentUser->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User|null $currentUser
     * @return bool
     */
    public function store(?User $currentUser)
    {
        return true;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Customer $customer
     * @return bool
     */
    public function show(User $currentUser, Customer $customer)
    {

        if ($currentUser->id === $customer->userId) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Customer $customer
     * @return bool
     */
    public function update(User $currentUser, Customer $customer)
    {
        $user = $customer->user;

        if ($user instanceof User) {
            return $currentUser->id === $user->id;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Customer $customer
     * @return bool
     */
    public function destroy(User $currentUser, Customer $customer)
    {

        if ($currentUser->id === $currentUser->userId) {
            return true;
        }

        return false;
    }
}
