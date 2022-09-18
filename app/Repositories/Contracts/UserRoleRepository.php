<?php


namespace App\Repositories\Contracts;


interface UserRoleRepository extends BaseRepository
{
    /**
     * get user ids of the property
     *
     * @param int $propertyId
     * @return mixed
     */
    public function getUserIdsOfEntireProperty(int $propertyId);

    /**
     * get all user ids of the property residents
     *
     * @param int $propertyId
     * @return mixed
     */
    public function getUserIdsOfThePropertyResidents(int $propertyId);

    /**
     * get all users' ids of the property staffs
     *
     * @param int $propertyId
     * @return mixed
     */
    public function getUserIdsOfThePropertyStaffs(int $propertyId);

    /**
     * get all user ids by roleId in a property
     *
     * @param int $propertyId
     * @param int $roleId
     * @return mixed
     */
    public function getUserIdsByRoleId(int $propertyId, int $roleId);

    /**
     * get all emails of staffs of a property
     *
     * @param int $propertyId
     * @return mixed
     */
    public function getEmailsOfThePropertyStaffs(int $propertyId);
}
