<?php

namespace App\Events\Role;

use App\DbModels\Role;
use Illuminate\Queue\SerializesModels;

class RoleCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Role
     */
    public $role;

    /**
     * Create a new event instance.
     *
     * @param Role $role
     * @param array $options
     */
    public function __construct(Role $role, array $options = [])
    {
        $this->role = $role;
        $this->options = $options;
    }
}
