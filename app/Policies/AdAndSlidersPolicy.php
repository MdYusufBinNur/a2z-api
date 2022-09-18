<?php

namespace App\Policies;

use App\DbModels\AdAndSlider;
use App\DbModels\Admin;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdAndSlidersPolicy
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
        return true;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Admin $admin
     * @return bool
     */
    public function show(User $currentUser,  Admin $admin)
    {
        return true;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param AdAndSlider $adAndSliders
     * @return bool
     */
    public function update(User $currentUser, AdAndSlider $adAndSliders)
    {
        return true;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param AdAndSlider $adAndSliders
     * @return bool
     */
    public function destroy(User $currentUser, AdAndSlider $adAndSliders)
    {
        return true;
    }
}
