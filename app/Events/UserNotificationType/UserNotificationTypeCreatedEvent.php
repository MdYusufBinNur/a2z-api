<?php

namespace App\Events\UserNotificationType;

use App\DbModels\UserNotificationType;
use Illuminate\Queue\SerializesModels;

class UserNotificationTypeCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserNotificationType
     */
    public $userNotificationType;

    /**
     * Create a new event instance.
     *
     * @param UserNotificationType $userNotificationType
     * @param array $options
     */
    public function __construct(UserNotificationType $userNotificationType, array $options = [])
    {
        $this->userNotificationType = $userNotificationType;
        $this->options = $options;
    }
}
