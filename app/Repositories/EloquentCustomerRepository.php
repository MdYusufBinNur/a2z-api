<?php


namespace App\Repositories;


use App\DbModels\PasswordReset;
use App\DbModels\Role;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use App\Services\Helpers\RoleHelper;
use Illuminate\Support\Facades\DB;

class EloquentCustomerRepository extends EloquentBaseRepository implements CustomerRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        if (isset($searchCriteria['query'])) {
            $queryBuilder = $queryBuilder
                ->where('name', 'like', '%'.$searchCriteria['query'].'%')
                ->orwhere('email', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('phone', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('address', 'like', '%'.$searchCriteria['query'].'%');
            unset($searchCriteria['query']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);

        if (empty($searchCriteria['withOutPagination'])) {
            return $queryBuilder->paginate($limit);
        } else {
            return $queryBuilder->get();
        }
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $userRepository = app(UserRepository::class);

        if (isset($data['user'])) {
            $data['user']['isActive'] = false;
            $user = $userRepository->save($data['user']);
            $data['userId'] = $user->id;
        }

        //create user role
        $userRoleRepository = app(UserRoleRepository::class);
        $userRole = $userRoleRepository->save(['roleId' => Role::ROLE_CUSTOMER_GENERAL['id'],  'userId' => $data['userId']]);

        $data['userRoleId'] = $userRole->id;

        $customer = parent::save($data);

        DB::commit();

        //create pin to set password
        $passwordResetRepository = app(PasswordResetRepository::class);
        $passwordResetRepository->save(['userId' => $data['userId'], 'type' => PasswordReset::TYPE_SET_PASSWORD_BY_PIN]);

        return $customer;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $customer, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $customer = parent::update($customer, $data);
        $userRepository = app(UserRepository::class);

        if (isset($data['user'])) {
            $userRepository->updateUser($customer->user, $data['user']);
        }

        if (array_key_exists('level', $data)) {

            if ($this->getLoggedInUser()->isAdmin()) {
                $roleId = Role::ROLE_CUSTOMER_STAR['id'];
            } else {
                $roleId = RoleHelper::getRoleIdByTitle($data['level']);
            }

            // update user role
            $userRoleRepository = app(UserRoleRepository::class);
            $userRoleRepository->update($customer->userRole, ['roleId' => $roleId]);
        }

        DB::commit();

        return $customer;
    }


}
