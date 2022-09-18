<?php

namespace App\Listeners\Admin;

use App\Events\Admin\AdminCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleAdminCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  AdminCreatedEvent  $event
     * @return void
     */
    public function handle(AdminCreatedEvent $event)
    {
        $admin = $event->admin;
        $eventOptions = $event->options;
    }
}
