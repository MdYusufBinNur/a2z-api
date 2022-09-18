<?php


namespace App\Repositories\Contracts;


use ArrayAccess;

interface PaymentTransactionRepository extends BaseRepository
{
    /**
     * update a user
     *
     * @param array $data
     * @return array
     */
    public function aamarpaySuccessfulPayment(array $data): array;

    /**
     * update a user
     *
     * @param array $data
     * @return array
     */
    public function aamarpayFailedPayment(array $data): array;

}
