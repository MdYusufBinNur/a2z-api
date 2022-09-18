<?php

namespace App\Listeners\UserNotificationSetting;

use App\Events\UserNotificationSetting\UserNotificationSettingUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserNotificationSettingUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserNotificationSettingUpdatedEvent  $event
     * @return void
     */
    public function handle(UserNotificationSettingUpdatedEvent $event)
    {
        $userNotificationSetting = $event->userNotificationSetting;
        $eventOptions = $event->options;
        $oldUserNotificationSetting = $eventOptions['oldModel'];
    }
}
