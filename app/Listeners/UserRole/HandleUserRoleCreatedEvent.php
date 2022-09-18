<?php

namespace App\Listeners\UserRole;

use App\Events\UserRole\UserRoleCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserRoleCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserRoleCreatedEvent  $event
     * @return void
     */
    public function handle(UserRoleCreatedEvent $event)
    {
        $userRole = $event->userRole;
        $eventOptions = $event->options;
    }
}
