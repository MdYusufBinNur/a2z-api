<?php

namespace App\Listeners\UserNotification;

use App\Events\UserNotification\UserNotificationCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserNotificationCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserNotificationCreatedEvent  $event
     * @return void
     */
    public function handle(UserNotificationCreatedEvent $event)
    {
        $userNotification = $event->userNotification;
        $eventOptions = $event->options;
    }
}
