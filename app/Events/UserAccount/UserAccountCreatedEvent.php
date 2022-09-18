<?php

namespace App\Events\UserAccount;

use App\DbModels\UserAccount;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserAccountCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserAccount
     */
    public $userAccount;

    /**
     * Create a new event instance.
     *
     * @param UserAccount $userAccount
     * @param array $options
     */
    public function __construct(UserAccount $userAccount, array $options = [])
    {
        $this->userAccount = $userAccount;
        $this->options = $options;
    }
}
