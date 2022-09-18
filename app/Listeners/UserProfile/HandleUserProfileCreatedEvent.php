<?php

namespace App\Listeners\UserProfile;

use App\Events\UserProfile\UserProfileCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserProfileCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserProfileCreatedEvent  $event
     * @return void
     */
    public function handle(UserProfileCreatedEvent $event)
    {
        $userProfile = $event->userProfile;
        $eventOptions = $event->options;
    }
}
