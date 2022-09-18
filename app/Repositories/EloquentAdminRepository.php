<?php


namespace App\Repositories;


use App\DbModels\Admin;
use App\DbModels\PasswordReset;
use App\DbModels\Role;
use App\DbModels\User;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Services\Helpers\RoleHelper;
use App\Events\Admin\AdminCreatedEvent;
use App\Repositories\Contracts\AdminRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Facades\DB;

class EloquentAdminRepository extends EloquentBaseRepository implements AdminRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['admin.user' => 'user'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if(array_key_exists('users', $data)) {
            //create user
            $userRepository = app(UserRepository::class);
            $user = $userRepository->save(array_merge($data['users']));
            $data['userId'] = $user->id;
        }

        if (array_key_exists('level', $data)) {
            $roleId = RoleHelper::getRoleIdByTitle($data['level']);
        } else {
            $roleId = Role::ROLE_ADMIN_STANDARD['id'];
        }

        //create an user role
        $userRoleRepository = app(UserRoleRepository::class);
        $userRole = $userRoleRepository->save(['roleId' => $roleId, 'userId' => $data['userId']]);

        $data['level'] = Role::ROLE_ADMIN_STANDARD['title'];
        $data['userRoleId'] = $userRole->id;

        // create an admin user
        $adminUser = parent::save($data);
        DB::commit();

        // fire admin created event
        event( new AdminCreatedEvent($adminUser));

        //create pin to set password
        $passwordResetRepository = app(PasswordResetRepository::class);
        $passwordResetRepository->save(['userId' => $data['userId'], 'type' => PasswordReset::TYPE_SET_PASSWORD_BY_PIN]);

        return $adminUser;
    }

    /**
     *@inherit Doc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $admin = parent::update($model, $data);

        $userRepository = app(UserRepository::class);

        if(isset($data['users'])) {
            $userRepository->updateUser($admin->user, $data['users']);
        }

        if (array_key_exists('level', $data)) {
            $roleId = RoleHelper::getRoleIdByTitle($data['level']);

            // update user role
            $userRoleRepository = app(UserRoleRepository::class);
            $userRoleRepository->update($admin->userRole, ['roleId' => $roleId]);
        }

        DB::commit();

        return $admin;
    }

    /*
     * @inheritDoc
     */
    public function deleteAdminUser(\ArrayAccess $adminUser, array $data = []): bool
    {
        DB::beginTransaction();

        $userRoleRepository = app(UserRoleRepository::class);
        $userRoleRepository->delete($adminUser->userRole);

        if (isset($data['completeDeletion'])) {

            //remove all roles
            $userRoles = $userRoleRepository->model->where(['userId' => $adminUser->user->id])->get();
            foreach ($userRoles as $userRole) {
                $userRoleRepository->delete($userRole);
            }

            //remove all users
            $userRepository = app(UserRepository::class);
            $userRepository->delete($adminUser->user);
        }

        parent::delete($adminUser);

        DB::commit();

        return true;
    }

    /**
     * shorten the search based on search criteria
     *
     * @param $searchCriteria
     * @return mixed
     */
    private function applyFilterInUserSearch($searchCriteria)
    {
        if (!$this->getLoggedInUser()->isSuperAdmin()) {
            $searchCriteria['level'] = Admin::LEVEL_LIMITED;
        }

        if (isset($searchCriteria['withName'])) {
            $searchCriteria['id'] = $this->getAdminUserIdsByName($searchCriteria);
            unset($searchCriteria['withName']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = implode(",", array_unique($searchCriteria['id']));
        }

        return $searchCriteria;
    }

    /**
     * @inheritDoc
     */
    public function getAdminUserIdsByName(array $searchCriteria = [])
    {
        $thisModelTable = $this->model->getTable();
        $userModelTable = User::getTableName();

        return $this->model
            ->select($thisModelTable . '.id')
            ->join($userModelTable, $userModelTable . '.id', '=', $thisModelTable . '.userId')
            ->where($userModelTable . '.name', 'like', '%' . $searchCriteria['withName'] . '%')
            ->orWhere($userModelTable . '.email', 'like', '%' . $searchCriteria['withName'] . '%')
            ->pluck('id')->toArray();
    }

}
