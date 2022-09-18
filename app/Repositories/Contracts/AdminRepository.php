<?php


namespace App\Repositories\Contracts;


interface AdminRepository extends BaseRepository
{
    /**
     * get admin user' ids by searching name from user table
     *
     * @param array $searchCriteria
     * @return array
     */
    public function getAdminUserIdsByName(array $searchCriteria = []);

    /**
     * delete an admin user
     *
     * @param \ArrayAccess $adminUser
     * @param array $data
     * @return bool
     */
    public function deleteAdminUser(\ArrayAccess $adminUser, array $data = []): bool;
}
