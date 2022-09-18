<?php

namespace App\Events\MessagePost;

use App\DbModels\MessagePost;
use Illuminate\Queue\SerializesModels;

class MessagePostUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var MessagePost
     */
    public $messagePost;

    /**
     * Create a new event instance.
     *
     * @param MessagePost $messagePost
     * @param array $options
     */
    public function __construct(MessagePost $messagePost, array $options = [])
    {
        $this->messagePost = $messagePost;
        $this->options = $options;
    }
}
