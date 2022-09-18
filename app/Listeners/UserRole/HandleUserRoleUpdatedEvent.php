<?php

namespace App\Listeners\UserRole;

use App\Events\UserRole\UserRoleUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserRoleUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserRoleUpdatedEvent  $event
     * @return void
     */
    public function handle(UserRoleUpdatedEvent $event)
    {
        $userRole = $event->userRole;
        $eventOptions = $event->options;
        $oldUserRole = $eventOptions['oldModel'];
    }
}
