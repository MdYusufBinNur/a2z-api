<?php

namespace App\Listeners\MessagePost;

use App\Events\MessagePost\MessagePostUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleMessagePostUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  MessagePostUpdatedEvent  $event
     * @return void
     */
    public function handle(MessagePostUpdatedEvent $event)
    {
        $messagePost = $event->messagePost;
        $eventOptions = $event->options;
        $oldMessagePost = $eventOptions['oldModel'];
    }
}
