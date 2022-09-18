<?php

namespace App\Events\MessageUser;

use App\DbModels\MessageUser;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class MessageUserUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var MessageUser
     */
    public $messageUser;

    /**
     * Create a new event instance.
     *
     * @param MessageUser $messageUser
     * @param array $options
     */
    public function __construct(MessageUser $messageUser, array $options = [])
    {
        $this->messageUser = $messageUser;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
