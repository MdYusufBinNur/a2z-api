<?php

namespace App\Events\UserNotificationSetting;

use App\DbModels\UserNotificationSetting;
use Illuminate\Queue\SerializesModels;

class UserNotificationSettingCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserNotificationSetting
     */
    public $userNotificationSetting;

    /**
     * Create a new event instance.
     *
     * @param UserNotificationSetting $userNotificationSetting
     * @param array $options
     */
    public function __construct(UserNotificationSetting $userNotificationSetting, array $options = [])
    {
        $this->userNotificationSetting = $userNotificationSetting;
        $this->options = $options;
    }
}
