<?php

namespace App\Listeners\UserNotificationType;

use App\Events\UserNotificationType\UserNotificationTypeUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserNotificationTypeUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserNotificationTypeUpdatedEvent  $event
     * @return void
     */
    public function handle(UserNotificationTypeUpdatedEvent $event)
    {
        $userNotificationType = $event->userNotificationType;
        $eventOptions = $event->options;
        $oldUserNotificationType = $eventOptions['oldModel'];
    }
}
