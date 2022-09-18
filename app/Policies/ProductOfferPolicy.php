<?php

namespace App\Policies;

use App\DbModels\Product;
use App\DbModels\ProductOffer;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductOfferPolicy
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
        if ($currentUser->isStandardAdmin()) {
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
     * @param ProductOffer $productOffer
     * @return bool
     */
    public function show(User $currentUser, ProductOffer $productOffer)
    {
        return true;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param ProductOffer $productOffer
     * @return bool
     */
    public function update(User $currentUser, ProductOffer $productOffer)
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
     * @param ProductOffer $productOffer
     * @return bool
     */
    public function destroy(User $currentUser, ProductOffer $productOffer)
    {
        if ($currentUser->isStandardAdmin()) {
            return true;
        }

        return false;
    }
}
