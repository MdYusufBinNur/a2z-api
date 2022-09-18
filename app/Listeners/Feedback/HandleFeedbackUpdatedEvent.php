<?php

namespace App\Listeners\Feedback;

use App\Events\Feedback\FeedbackUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFeedbackUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  FeedbackUpdatedEvent  $event
     * @return void
     */
    public function handle(FeedbackUpdatedEvent $event)
    {
        $feedback = $event->feedback;
        $eventOptions = $event->options;
        $oldFeedback = $eventOptions['oldModel'];
    }
}
