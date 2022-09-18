<?php

namespace App\Listeners\MessageTemplate;

use App\Events\MessageTemplate\MessageTemplateUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleMessageTemplateUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  MessageTemplateUpdatedEvent  $event
     * @return void
     */
    public function handle(MessageTemplateUpdatedEvent $event)
    {
        $messageTemplate = $event->messageTemplate;
        $eventOptions = $event->options;
        $oldMessageTemplate = $eventOptions['oldModel'];
    }
}
