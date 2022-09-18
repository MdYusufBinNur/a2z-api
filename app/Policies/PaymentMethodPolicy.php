<?php

namespace App\Policies;

use App\DbModels\PaymentMethod;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentMethodPolicy
{
    use HandlesAuthorization, ValidateModules;

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

        if (!$this->isModuleActiveForTheProperty(Module::MODULE_PAYMENT_CENTER)) {
            return false;
        }
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function list(User $currentUser, int $propertyId)
    {
        return true;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $propertyId
     * @return bool
     */
    public function store(User $currentUser, int $propertyId)
    {
        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param PaymentMethod $paymentMethod
     * @return bool
     */
    public function show(User $currentUser,  PaymentMethod $paymentMethod)
    {
        return true;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param PaymentMethod $paymentMethod
     * @return bool
     */
    public function update(User $currentUser, PaymentMethod $paymentMethod)
    {
        $propertyId = $paymentMethod->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param PaymentMethod $paymentMethod
     * @return bool
     */
    public function destroy(User $currentUser, PaymentMethod $paymentMethod)
    {
        $propertyId = $paymentMethod->propertyId;

        if ($currentUser->isAnEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
