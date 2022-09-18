<?php

namespace App\Events\Feedback;

use App\DbModels\Feedback;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FeedbackDeletedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Feedback
     */
    public $feedback;

    /**
     * Create a new event instance.
     *
     * @param Feedback $feedback
     * @param array $options
     */
    public function __construct(Feedback $feedback, array $options = [])
    {
        $this->feedback = $feedback;
        $this->options = $options;
    }
}
