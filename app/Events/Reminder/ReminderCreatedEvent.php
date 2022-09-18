<?php

namespace App\Events\Reminder;

use App\DbModels\Reminder;
use Illuminate\Queue\SerializesModels;

class ReminderCreatedEvent
{
    use SerializesModels;

    /**
     * @var Reminder
     */
    public $reminder;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Reminder $reminder
     * @param array $options
     */
    public function __construct(Reminder $reminder, array $options = [])
    {
        $this->reminder = $reminder;
        $this->options = $options;
    }
}
