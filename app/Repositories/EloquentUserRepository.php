<?php

namespace App\Repositories;

use App\DbModels\UserAccount;
use App\DbModels\UserRole;
use App\Events\User\UserCreatedEvent;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\Contracts\UserAccountRepository;
use App\Repositories\Contracts\UserProfileRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {

        /*$cacheKey = 'findBy:user-search:' . json_encode($searchCriteria);
        if (($users = $this->getCacheByKey($cacheKey))) {
            return $users;
        }*/

        $searchCriteria = $this->applyFilterInUserSearch($searchCriteria);

        $searchCriteria['eagerLoad'] = ['user.roles' => 'userRoles', 'user.profilePic' => 'profilePic', 'user.userProfile' => 'userProfile', 'user.customer' => 'customer', 'user.staff' => 'staff', 'userRole.role' => 'userRoles.role'];

        $users = parent::findBy($searchCriteria, $withTrashed);

        //$this->setCacheByKey($cacheKey, $users);

        return $users;
    }

    /**
     * @inheritdoc
     */
    public function findOne($id, $withTrashed = false): ?\ArrayAccess
    {
        if ($id === 'me') {
            return $this->getLoggedInUser();
        }

        return parent::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $user = parent::save($data);

        if (isset($data['role'])) {
            $data['role']['userId'] = $user->id;
            $userRoleRepository = app(UserRoleRepository::class);
            $userRoleRepository->save($data['role']);
        }

        DB::commit();

        event(new UserCreatedEvent($user, $this->generateEventOptionsForModel()));

        return $user;
    }

    /**
     * @inheritDoc
     */
    public function updateUser(\ArrayAccess $model, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        if (!empty($data['notificationSeen'])) {
            $data['notificationSeenAt'] = Carbon::now();
            unset($data['notificationSeen']);
        }

        $user = parent::update($model, $data);


        $userRoleRepository = app(UserRoleRepository::class);

        if (array_key_exists('role', $data)) {

            if (isset($data['role']['oldRoleId'])) {
                $userRole = $userRoleRepository->findOneBy(['userId' => $user->id, 'roleId' => $data['role']['oldRoleId']]);
                if ($userRole instanceof UserRole) {
                    $userRoleRepository->update($userRole, $data['role']);
                } else {
                    throw new NotFoundHttpException();
                }
            } else {
                $data['role']['userId'] = $user->id;
                $userRoleRepository->patch($data['role'], $data['role']);
            }
        }

        DB::commit();

        return $user;
    }

    /**
     * shorten the search based on search criteria
     *
     * @param $searchCriteria
     * @return mixed
     */
    private function applyFilterInUserSearch($searchCriteria)
    {
        if (isset($searchCriteria['query'])) {
            $searchCriteria['id'] = $this->model->where('email', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('name', 'like', '%' . $searchCriteria['query'] . '%')
                ->pluck('id')->toArray();
            unset($searchCriteria['query']);
        }

        if (isset($searchCriteria['roleId']) || isset($searchCriteria['propertyId'])) {
            $userRoleRepository = app(UserRoleRepository::class);
            $queryBuilder = $userRoleRepository->model->select('userId');

            if (isset($searchCriteria['roleId'])) {
                if (!is_array($searchCriteria['roleId'])) {
                    $searchCriteria['roleId'] = [$searchCriteria['roleId']];
                }
                $queryBuilder = $queryBuilder->whereIn('roleId', $searchCriteria['roleId']);
            }

            if (isset($searchCriteria['propertyId'])) {
                $queryBuilder = $queryBuilder->where('propertyId', $searchCriteria['propertyId']);
            }

            $userIds = $queryBuilder->pluck('userId')->toArray();
            if (isset($searchCriteria['id'])) {
                if (is_array($searchCriteria['id'])) {
                    $searchCriteria['id'] = array_intersect($searchCriteria['id'], $userIds);
                } else {
                    $searchCriteria['id'] = array_intersect(explode(',', $searchCriteria['id']), $userIds);
                }
            } else {
                $searchCriteria['id'] = $userIds;
            }

            unset($searchCriteria['roleId']);
            unset($searchCriteria['propertyId']);
        }

        if (isset($searchCriteria['id'])) {
            $searchCriteria['id'] = is_array($searchCriteria['id']) ? implode(",", array_unique($searchCriteria['id'])) : $searchCriteria['id'];
        }

        return $searchCriteria;
    }

    /**
     * @inheritDoc
     */
    public function findUserByEmailPhone($emailOrPhone)
    {
        return $this->model->where(['email' => $emailOrPhone])
            ->orWhere(['phone' => $emailOrPhone])
            ->first();
    }

    /**
     * @inheritDoc
     */
    public function getProfilePicByUserId($userId, $size = 'medium')
    {
        $attachmentRepository = app(AttachmentRepository::class);
        $profileAttachment = $attachmentRepository->getProfilePicByResourceId($userId, $size);

        return $profileAttachment;
    }
}
