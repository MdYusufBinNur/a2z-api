<?php

namespace App\Listeners\Role;

use App\Events\Role\RoleCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleRoleCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  RoleCreatedEvent  $event
     * @return void
     */
    public function handle(RoleCreatedEvent $event)
    {
        $role = $event->role;
        $eventOptions = $event->options;
    }
}
