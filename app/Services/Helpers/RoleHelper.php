<?php

namespace App\Services\Helpers;

use App\DbModels\Role;

class RoleHelper
{
    /**
     * get all roles
     *
     * @return array
     * @throws \ReflectionException
     */
    public static function allRoles()
    {
        $reflectionClass = new \ReflectionClass(Role::class);

        $rolesWithName = array_filter($reflectionClass->getConstants(), function ($constant) {
            return strpos($constant, 'ROLE_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        return array_values($rolesWithName);
    }

    /**
     * get a role by id
     *
     * @param int $id
     * @return mixed|null
     * @throws \ReflectionException
     */
    public static function getRoleById(int $id)
    {
        $roles = self::allRoles();
        $key = array_search($id, array_column($roles, 'id'));

        return $key !== false ? $roles[$key] : null;
    }

    /**
     * get a role by title
     *
     * @param string $title
     * @return mixed|null
     * @throws \ReflectionException
     */
    public static function getRoleByTitle(string $title)
    {
        $roles = self::allRoles();
        $key = array_search($title, array_column($roles, 'title'));

        return $key !== false ? $roles[$key] : null;
    }

    /**
     * get a role's title by id
     *
     * @param int $id
     * @return mixed
     * @throws \ReflectionException
     */
    public static function getRoleTitleById(int $id)
    {
        $role = self::getRoleById($id);
        return $role['title'];
    }

    /**
     * get a role's id by title
     *
     * @param string $title
     * @return mixed
     * @throws \ReflectionException
     */
    public static function getRoleIdByTitle(string $title)
    {
        $role = self::getRoleByTitle($title);
        return $role['id'];
    }

    /**
     * get all roles by types
     *
     * @param array $types
     * @return mixed
     * @throws \ReflectionException
     */
    public static function getAllRolesByTypes(array $types)
    {
        $roles = self::allRoles();

        $rolesTypeTypes = [];
        foreach ($roles as $role) {
            if (in_array($role['type'], $types)) {
                $rolesTypeTypes[] = $role;
            }
        }

        return $rolesTypeTypes;
    }

    /**
     * get all roles' ids by types
     *
     * @param array $types
     * @return mixed
     * @throws \ReflectionException
     */
    public static function getAllRoleIdsByTypes(array $types)
    {
        $roles = self::getAllRolesByTypes($types);

        return array_column($roles, 'id');
    }


}
