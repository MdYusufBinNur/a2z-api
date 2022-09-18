<?php

namespace App\Listeners\Reminder;

use App\DbModels\Reminder;
use App\DbModels\UserNotificationType;
use App\Events\Reminder\ReminderCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Reminder\SendReminder;
use App\Repositories\Contracts\ReminderRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use App\Services\Reminder\ReminderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleReminderCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var ReminderRepository
     */
    private $reminderRepository;

    /**
     * HandlePaymentItemUpdatedEvent constructor.
     * @param ReminderRepository $reminderRepository
     */
    public function __construct(ReminderRepository $reminderRepository)
    {
        $this->reminderRepository = $reminderRepository;
    }

    /**
     * Handle the event.
     *
     * @param  ReminderCreatedEvent  $event
     * @return void
     */
    public function handle(ReminderCreatedEvent $event)
    {
        $reminder = $event->reminder;
        $eventOptions = $event->options;

        ReminderService::sendReminderByResourceType($reminder,$eventOptions);
    }
}
