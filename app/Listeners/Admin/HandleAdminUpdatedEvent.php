<?php

namespace App\Listeners\Admin;

use App\Events\Admin\AdminUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleAdminUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  AdminUpdatedEvent  $event
     * @return void
     */
    public function handle(AdminUpdatedEvent $event)
    {
        $admin = $event->admin;
        $eventOptions = $event->options;
        $oldAdmin = $eventOptions['oldModel'];
    }
}
