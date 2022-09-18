<?php

namespace App\Listeners\Role;

use App\Events\Role\RoleUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleRoleUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  RoleUpdatedEvent  $event
     * @return void
     */
    public function handle(RoleUpdatedEvent $event)
    {
        $role = $event->role;
        $eventOptions = $event->options;
        $oldRole = $eventOptions['oldModel'];
    }
}
