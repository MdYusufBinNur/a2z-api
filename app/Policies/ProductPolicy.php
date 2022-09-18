<?php

namespace App\Policies;

use App\DbModels\Product;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
        return true;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @return bool
     */
    public function store(User $currentUser)
    {
        if ($currentUser->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Product $product
     * @return bool
     */
    public function show(User $currentUser, Product $product)
    {
        return true;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Product $product
     * @return bool
     */
    public function update(User $currentUser, Product $product)
    {
        if ($currentUser->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Product $product
     * @return bool
     */
    public function destroy(User $currentUser, Product $product)
    {
        if ($currentUser->isStandardAdmin()) {
            return true;
        }

        return false;
    }
}
