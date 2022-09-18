<?php


namespace App\Repositories\Contracts;

interface PaymentItemRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function generateTransaction(array $data);
}
