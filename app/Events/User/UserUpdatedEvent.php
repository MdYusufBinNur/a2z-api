<?php

namespace App\Events\User;

use App\DbModels\User;
use Illuminate\Queue\SerializesModels;

class UserUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param array $options
     */
    public function __construct(User $user, array $options = [])
    {
        $this->user = $user;
        $this->options = $options;
    }
}
