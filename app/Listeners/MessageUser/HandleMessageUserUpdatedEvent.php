<?php

namespace App\Listeners\MessageUser;

use App\Events\MessageUser\MessageUserUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleMessageUserUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  MessageUserUpdatedEvent  $event
     * @return void
     */
    public function handle(MessageUserUpdatedEvent $event)
    {
        $messageUser = $event->messageUser;
        $eventOptions = $event->options;
        $oldMessageUser = $eventOptions['oldModel'];
    }
}
