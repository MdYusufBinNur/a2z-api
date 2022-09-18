<?php


namespace App\Repositories;


use App\DbModels\Admin;
use App\DbModels\Customer;
use App\DbModels\Staff;
use App\Repositories\Contracts\AdminRepository;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\StaffRepository;
use App\Repositories\Contracts\UserProfileRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EloquentUserProfileRepository extends EloquentBaseRepository implements UserProfileRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['userId'] = isset($searchCriteria['userId']) ?  $searchCriteria['userId'] : $this->getLoggedInUser()->id;
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function setUserProfile(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $data['userId'] = isset($data['userId']) ? $data['userId'] : $this->getLoggedInUser()->id;
        $userProfile = $this->patch(['userId' => $data['userId']], $data);

        if (array_key_exists('user', $data)) {
            $userRepository = app(UserRepository::class);
            $customerRepository = app(CustomerRepository::class);
            $adminRepository = app(AdminRepository::class);
            $staffRepository = app(StaffRepository::class);

            $user = $userRepository->updateUser($userProfile->user, $data['user']);

            $customer = $user->customer;
            $admin = $user->admin;
            $staff = $user->staff;

            if ($customer instanceof Customer) {
                $customerRepository->update($customer, $data['user']);
            }

            if ($admin instanceof Admin) {
                $adminRepository->update($admin, $data['user']);
            }

            if ($staff instanceof Staff) {
                $staffRepository->update($staff, $data['user']);
            }
        }

        DB::commit();

        return $userProfile;
    }
}
