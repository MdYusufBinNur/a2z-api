<?php

namespace App\Policies;

use App\DbModels\ExpenseCategory;
use App\DbModels\Module;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpenseCategoryPolicy
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

        if (!$this->isModuleActiveForTheProperty( Module::MODULE_INCOME_EXPENSE)) {
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
        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
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
        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param ExpenseCategory $expenseCategory
     * @return bool
     */
    public function show(User $currentUser,  ExpenseCategory $expenseCategory)
    {
        $propertyId = $expenseCategory->propertyId;

        if ($currentUser->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }


        return false;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param ExpenseCategory $expenseCategory
     * @return bool
     */
    public function update(User $currentUser, ExpenseCategory $expenseCategory)
    {
        $propertyId = $expenseCategory->propertyId;

        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param ExpenseCategory $expenseCategory
     * @return bool
     */
    public function destroy(User $currentUser, ExpenseCategory $expenseCategory)
    {
        $propertyId = $expenseCategory->propertyId;

        if ($currentUser->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
