<?php

namespace App\Listeners\UserNotificationSetting;

use App\Events\UserNotificationSetting\UserNotificationSettingCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserNotificationSettingCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserNotificationSettingCreatedEvent  $event
     * @return void
     */
    public function handle(UserNotificationSettingCreatedEvent $event)
    {
        $userNotificationSetting = $event->userNotificationSetting;
        $eventOptions = $event->options;
    }
}
