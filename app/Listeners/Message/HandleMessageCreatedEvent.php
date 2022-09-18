<?php

namespace App\Listeners\Message;

use App\DbModels\UserNotificationType;
use App\Events\Message\MessageCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Message\SendMessageNotification;
use App\Repositories\Contracts\UserNotificationRepository;
use App\Repositories\Contracts\UserNotificationTypeRepository;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleMessageCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param MessageCreatedEvent $event
     * @return void
     */
    public function handle(MessageCreatedEvent $event)
    {
        $message = $event->message;
        $eventOptions = $event->options;

        $property = $message->property;
        $fromUser = $message->fromUser;

        $notifyAbleMessageUsers = $message->notifyAbleMessageUsers;
        $messageText = $message->scopeLastMessagePostOfTheUser($fromUser->id)->first()->text;
        $needToSendEmailNotification = $message->emailNotification;
        $userNotificationRepository = app(UserNotificationRepository::class);

        foreach ($notifyAbleMessageUsers as $notifyAbleMessageUser) {

            $notifyAbleUser = $notifyAbleMessageUser->user;

            // send notification
            $userNotificationRepository->save([
                'fromUserId' => $message->fromUserId,
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
