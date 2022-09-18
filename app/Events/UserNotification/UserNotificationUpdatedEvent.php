<?php

namespace App\Events\UserNotification;

use App\DbModels\UserNotification;
use App\DbModels\UserNotificationType;
use Illuminate\Queue\SerializesModels;

class UserNotificationUpdatedEvent
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
     * @param UserNotification $userNotification
     * @param array $options
     */
    public function __construct(UserNotification $userNotification, array $options = [])
    {
        $this->userNotification = $userNotification;
        $this->options = $options;
    }
}
