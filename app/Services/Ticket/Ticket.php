<?php


namespace App\Services\Ticket;


interface Ticket
{
    /**
     * get all the tickets resources
     * @param array $options
     * @return mixed
     */
    public function index(array $options = []);


    /**
     * save a ticket resource
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function store(array $data = []);

    /**
     * find a ticket resource by id
     *
     * @param mixed $id
     * @return \ArrayAccess|null
     */
    public function show($id);

    /**
     * update a ticket resource
     *
     * @param $id
     * @param array $data
     * @return \ArrayAccess
     */
    public function update($id, array $data);

    /**
     * delete a ticket resource by id
     *
     * @param $id
     * @return bool
     */
    public function delete($id);
}
