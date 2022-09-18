<?php

namespace App\Repositories\Contracts;

interface BaseRepository
{
    /**
     * find a resource by id
     *
     * @param mixed $id
     * @param bool $withTrashed
     * @return \ArrayAccess|null
     */
    public function findOne($id, $withTrashed = false): ?\ArrayAccess;

    /**
     * find a resource by criteria
     *
     * @param array $criteria
     * @param bool $withTrashed
     * @param bool $withLatest
     * @param string $latestBy
     * @return \ArrayAccess | null
     */
    public function findOneBy(array $criteria, $withTrashed = false,$withLatest = false, $latestBy = 'updated_at'): ?\ArrayAccess;

    /**
     * Search All resources
     *
     * @param array $searchCriteria
     * @param bool $withTrashed
     * @return mixed
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false);


    /**
     * Search All resources without pagination (very expensive)
     *
     * @param array $searchCriteria
     * @param bool $withTrashed
     * @return mixed
     */
    public function findByWithoutPagination(array $searchCriteria = [], $withTrashed = false);

    /**
     * Search All resources by any values of a key
     *
     * @param string $key
     * @param array $values
     * @param bool $withTrashed
     * @return \IteratorAggregate | null
     */
    public function findIn(string $key, array $values, $withTrashed = false): ?\IteratorAggregate;

    /**
     * save a resource
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function save(array $data): \ArrayAccess;

    /**
     * update a resource
     *
     * @param \ArrayAccess $model
     * @param array $data
     * @return \ArrayAccess
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess;

    /**
     * delete a resource
     *
     * @param \ArrayAccess $model
     * @return bool
     */
    public function delete(\ArrayAccess $model): bool;

    /**
     * updated records by specific key and values
     *
     * @param string $key
     * @param array $values
     * @param array $data
     * @return \IteratorAggregate
     */
    public function updateIn(string $key, array $values, array $data): ?\IteratorAggregate;

    /**
     * patch a resource
     *
     * @param array $searchCriteria
     * @param array $data
     * @return \ArrayAccess
     */
    public function patch(array $searchCriteria, array $data): \ArrayAccess;
}
