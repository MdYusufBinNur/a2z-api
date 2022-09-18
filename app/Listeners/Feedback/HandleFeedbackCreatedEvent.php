<?php

namespace App\Listeners\Feedback;

use App\Events\Feedback\FeedbackCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Services\Ticket\TicketService\FreshDesk;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFeedbackCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param FeedbackCreatedEvent $event
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(FeedbackCreatedEvent $event)
    {
        $feedback = $event->feedback;
        $eventOptions = $event->options;
        $property = $feedback->property;
        $userData = $feedback->createdByUser;
        $images = $feedback->attachments;

        $attachments = '';
        foreach ($images as $key => $attachment){
            if (strpos($attachment->fileType, 'image') !== false){
                $attachments .= '<br><br><img src="' . $attachment->getFileUrl() . '">';
            } else {
                $attachments .= '<br><br><a src="' . $attachment->getFileUrl() . '">';
            }
        }

        $data = [
            'name' => $userData->name,
            'phone' => $userData->phone,
            'requester_id' => $userData->id,
            'email' => $userData->email,
            'subject' => 'User Feedback from '. $property->title,
            'description' => $feedback->feedbackText . $attachments,
            'priority' => 2,
            'status' => 2,
            'custom_fields' => [
                "cf_feedback_app_id" => (string)$feedback->id,
            ],
        ];

        app()->make(FreshDesk::class)->store($data);
    }
}
