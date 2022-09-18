<?php

namespace App\Listeners\User;

use App\Events\User\UserUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserUpdatedEvent  $event
     * @return void
     */
    public function handle(UserUpdatedEvent $event)
    {
        $user = $event->user;
        $eventOptions = $event->options;
        $oldUser = $eventOptions['oldModel'];
    }
}
