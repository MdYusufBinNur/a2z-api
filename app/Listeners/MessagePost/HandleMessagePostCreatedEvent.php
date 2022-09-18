<?php

namespace App\Listeners\MessagePost;

use App\DbModels\UserNotificationType;
use App\Events\MessagePost\MessagePostCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Message\SendMessageNotification;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleMessagePostCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  MessagePostCreatedEvent  $event
     * @return void
     */
    public function handle(MessagePostCreatedEvent $event)
    {
        $messagePost = $event->messagePost;
        $eventOptions = $event->options;

        $message = $messagePost->message;
        $property = $message->property;
        $fromUser = $messagePost->fromUser;

        if (isset($eventOptions['request']['messageId'])) {

            $notifyAbleMessageUsers = $messagePost->notifyAbleMessageUsers;
            $messageText = $messagePost->text;
            $needToSendEmailNotification = $message->emailNotification;
            $userNotificationRepository = app(UserNotificationRepository::class);

            foreach ($notifyAbleMessageUsers as $notifyAbleMessageUser) {

                $notifyAbleUser = $notifyAbleMessageUser->user;

                // send notification
                $userNotificationRepository->save([
                    'fromUserId' => $fromUser->id,
                    'toUserId' => $notifyAbleUser->id,
                    'userNotificationTypeId' => UserNotificationType::MESSAGE['id'],
                    'resourceId' => $notifyAbleMessageUser->id,
                    'message' => 'New message from ' . $fromUser->name,
                ]);

                // send email
                if ($needToSendEmailNotification) {
                    Mail::to($notifyAbleUser->email)->send(new SendMessageNotification($message, $property, $fromUser, $notifyAbleUser, $messageText));
                }
            }
        }
    }
}
