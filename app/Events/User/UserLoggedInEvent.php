<?php

namespace App\Events\User;

use App\DbModels\User;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Events\Login;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class UserLoggedInEvent implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var Login
     */
    public $user;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param array $options
     * @return void
     */
    public function __construct(User $user, array $options = [])
    {
        $this->user = $user;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        $channels[] = new PrivateChannel('ADMIN.' . $this->user->id);

        return $channels;

    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return ['newLogin'];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'user' => new UserResource($this->user)
        ];
    }
}
