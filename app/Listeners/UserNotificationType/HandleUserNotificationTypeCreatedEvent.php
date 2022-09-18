<?php

namespace App\Listeners\UserNotificationType;

use App\Events\UserNotificationType\UserNotificationTypeCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserNotificationTypeCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserNotificationTypeCreatedEvent  $event
     * @return void
     */
    public function handle(UserNotificationTypeCreatedEvent $event)
    {
        $userNotificationType = $event->userNotificationType;
        $eventOptions = $event->options;
    }
}
