<?php

namespace App\Listeners\Feedback;

use App\Events\Feedback\FeedbackCreatedEvent;
use App\Events\Feedback\FeedbackDeletedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Services\Ticket\TicketService\FreshDesk;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFeedbackDeletedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param FeedbackDeletedEvent $event
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(FeedbackDeletedEvent $event)
    {
        $feedback = $event->feedback;
        $eventOptions = $event->options;

        app()->make(FreshDesk::class)->delete($feedback->id);
    }
}
