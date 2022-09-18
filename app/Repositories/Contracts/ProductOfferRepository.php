<?php


namespace App\Repositories\Contracts;


use ArrayAccess;

interface ProductOfferRepository extends BaseRepository
{

    /**
     * update a user
     *
     * @param array $data
     * @return ArrayAccess
     */
    public function saveProductOffer(array $data): ArrayAccess;
}
