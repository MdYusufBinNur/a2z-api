<?php

namespace App\Events\Message;

use App\DbModels\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Message $message
     * @param array $options
     * @return void
     */
    public function __construct(Message $message, array $options = [])
    {
        $this->message = $message;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        if ($this->message->isGroupMessage) {
            $toUserIds = explode(',', $this->message->group);
        } else {
            $toUserIds = [$this->message->toUserId];
        }

        $channels = [];
        foreach ($toUserIds as $toUserId) {
            $channels[] = new PrivateChannel('USER.' . $toUserId);
        }

        return $channels;

    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return ['newMessage'];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $fromUser = $this->message->fromUser;
        return [
            'subject' => $this->message->subject,
            'fromUser' => ['name' => $fromUser->name, 'email' => $fromUser->email],
            'text' => $this->options["request"]["text"],
            'created_at' => $this->message->created_at,
            'updated_at' => $this->message->updated_at,

        ];
    }

}
