<?php

namespace App\Listeners\UserProfile;

use App\Events\UserProfile\UserProfileUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserProfileUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserProfileUpdatedEvent  $event
     * @return void
     */
    public function handle(UserProfileUpdatedEvent $event)
    {
        $userProfile = $event->userProfile;
        $eventOptions = $event->options;
        $oldUserProfile = $eventOptions['oldModel'];
    }
}
