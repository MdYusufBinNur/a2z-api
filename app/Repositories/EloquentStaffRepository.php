<?php


namespace App\Repositories;


use App\DbModels\PasswordReset;
use App\DbModels\Role;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Repositories\Contracts\StaffRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use App\Services\Helpers\RoleHelper;
use Illuminate\Support\Facades\DB;

class EloquentStaffRepository extends EloquentBaseRepository implements StaffRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $userRepository = app(UserRepository::class);
        if (isset($data['user'])) {
            $user = $userRepository->save($data['user']);
            $data['userId'] = $user->id;
        }

        if (array_key_exists('level', $data)) {
            if ($this->getLoggedInUser()->isAdmin()) {
                $roleId = Role::ROLE_STAFF_STANDARD['id'];
            } else {
                $roleId = RoleHelper::getRoleIdByTitle($data['level']);
            }
        } else {
            $roleId = Role::ROLE_STAFF_LIMITED['id'];
        }

        //create user role
        $userRoleRepository = app(UserRoleRepository::class);
        $userRole = $userRoleRepository->save(['roleId' => $roleId,  'userId' => $data['userId']]);

        $data['userRoleId'] = $userRole->id;
        $data['level'] = RoleHelper::getRoleTitleById($roleId);
        $staff = parent::save($data);

        DB::commit();

        //create pin to set password
        $passwordResetRepository = app(PasswordResetRepository::class);
        $passwordResetRepository->save(['userId' => $data['userId'], 'type' => PasswordReset::TYPE_SET_PASSWORD_BY_PIN]);

        return $staff;

    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $staff, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $staff = parent::update($staff, $data);
        $userRepository = app(UserRepository::class);

        if (isset($data['user'])) {
            $userRepository->updateUser($staff->user, $data['user']);
        }

        if (array_key_exists('level', $data)) {

            if ($this->getLoggedInUser()->isAdmin()) {
                $roleId = Role::ROLE_STAFF_STANDARD['id'];
            } else {
                $roleId = RoleHelper::getRoleIdByTitle($data['level']);
            }

            // update user role
            $userRoleRepository = app(UserRoleRepository::class);
            $userRoleRepository->update($staff->userRole, ['roleId' => $roleId]);
        }

        DB::commit();

        return $staff;
    }
}
