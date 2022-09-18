<?php

namespace App\Listeners\UserNotification;

use App\Events\UserNotification\UserNotificationUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserNotificationUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserNotificationUpdatedEvent  $event
     * @return void
     */
    public function handle(UserNotificationUpdatedEvent $event)
    {
        $userNotification = $event->userNotification;
        $eventOptions = $event->options;
        $oldUserNotification = $eventOptions['oldModel'];
    }
}
