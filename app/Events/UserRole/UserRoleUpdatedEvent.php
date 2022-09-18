<?php

namespace App\Events\UserRole;

use App\DbModels\UserRole;
use Illuminate\Queue\SerializesModels;

class UserRoleUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserRole
     */
    public $userRole;

    /**
     * Create a new event instance.
     *
     * @param UserRole $userRole
     * @param array $options
     */
    public function __construct(UserRole $userRole, array $options = [])
    {
        $this->userRole = $userRole;
        $this->options = $options;
    }
}
