<?php

namespace App\Listeners\MessageTemplate;

use App\Events\MessageTemplate\MessageTemplateCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleMessageTemplateCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  MessageTemplateCreatedEvent  $event
     * @return void
     */
    public function handle(MessageTemplateCreatedEvent $event)
    {
        $messageTemplate = $event->messageTemplate;
        $eventOptions = $event->options;
    }
}
