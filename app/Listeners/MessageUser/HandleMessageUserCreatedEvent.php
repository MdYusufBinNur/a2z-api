<?php

namespace App\Listeners\MessageUser;

use App\Events\MessageUser\MessageUserCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleMessageUserCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  MessageUserCreatedEvent  $event
     * @return void
     */
    public function handle(MessageUserCreatedEvent $event)
    {
        $messageUser = $event->messageUser;
        $eventOptions = $event->options;
    }
}
