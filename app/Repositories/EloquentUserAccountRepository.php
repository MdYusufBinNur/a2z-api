<?php


namespace App\Repositories;


use App\Events\UserAccount\UserAccountCreatedEvent;
use App\Events\UserAccountLog\UserAccountLogCreatedEvent;
use App\Repositories\Contracts\UserAccountRepository;
use ArrayAccess;

class EloquentUserAccountRepository extends EloquentBaseRepository implements UserAccountRepository
{
    /**
     * @param array $data
     * @return ArrayAccess
     */
    public function save(array $data): ArrayAccess
    {
        $userAccount = parent::save($data);

        event(new UserAccountCreatedEvent($userAccount, $this->generateEventOptionsForModel()));

        return $userAccount;
    }
}
