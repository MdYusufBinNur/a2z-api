<?php


namespace App\Repositories;


use App\DbModels\Role;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;

class EloquentUserRoleRepository extends EloquentBaseRepository implements UserRoleRepository
{
    /**
     * @inheritDoc
     */
    public function getUserIdsOfEntireProperty(int $propertyId)
    {
        return $this->model->select(['userId'])->where(['propertyId' => $propertyId])->pluck('userId')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getUserIdsOfThePropertyResidents(int $propertyId)
    {
        return $this->model->select(['userId'])
            ->where(['propertyId' => $propertyId])
            ->whereIn('roleId', [Role::ROLE_RESIDENT_TENANT['id'], Role::ROLE_RESIDENT_OWNER['id']])
            ->pluck('userId')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getUserIdsOfThePropertyStaffs(int $propertyId)
    {
        return $this->model->select(['userId'])
            ->where(['propertyId' => $propertyId])
            ->whereIn('roleId', [Role::ROLE_STAFF_STANDARD['id'], Role::ROLE_STAFF_LIMITED['id'], Role::ROLE_STAFF_PRIORITY['id']])
            ->pluck('userId')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getUserIdsByRoleId(int $propertyId, int $roleId)
    {
        return $this->model->select(['userId'])
            ->where(['propertyId' => $propertyId])
            ->where(['roleId' => $roleId])
            ->pluck('userId')->toArray();
    }

    /**
     * @inheritDoc
     */
    public function getEmailsOfThePropertyStaffs(int $propertyId)
    {
        $userRepository = app(UserRepository::class);
        return $userRepository->model
            ->whereIn('id', $this->getUserIdsOfThePropertyStaffs($propertyId))
            ->pluck('email')->toArray();
    }

}
