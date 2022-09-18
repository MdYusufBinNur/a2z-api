<?php


namespace App\Services\Ticket\TicketService;


use App\Services\Ticket\Ticket;

class FreshDesk extends Base implements Ticket
{
    /**
     * @inheritDoc
     */
    public function index(array $options = [])
    {
        return $this->requestToAPI('GET', '/tickets', $options);
    }


    /**
     * @inheritDoc
     */
    public function store(array $data = [])
    {
        return $this->requestToAPI('POST', '/tickets',  $data);
    }

    /**
     * @inheritDoc
     */
    public function show($id)
    {
        return $this->requestToAPI('GET', '/tickets/'.$id);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        return $this->requestToAPI('PUT', '/tickets/'.$id,  $data);
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return $this->requestToAPI('DELETE', '/tickets/'.$id);
    }

}
