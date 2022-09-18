<?php


namespace App\Repositories\Contracts;


use App\DbModels\Payment;

interface PaymentRepository extends BaseRepository
{
    /**
     * save a payment
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function savePayment(array $data): \ArrayAccess;

    /**
     * update a payment
     *
     * @param Payment $model
     * @param array $data
     * @return \ArrayAccess
     */
    public function updatePayment(Payment $model, array $data): \ArrayAccess;

    /**
     * remove a payment
     *
     * @param Payment $payment
     * @return bool
     */
    public function removePayment(Payment $payment): bool;
}
