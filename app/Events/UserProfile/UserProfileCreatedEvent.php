<?php

namespace App\Events\UserProfile;

use App\DbModels\UserProfile;
use Illuminate\Queue\SerializesModels;

class UserProfileCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserProfile
     */
    public $userProfile;

    /**
     * Create a new event instance.
     *
     * @param UserProfile $userProfile
     * @param array $options
     */
    public function __construct(UserProfile $userProfile, array $options = [])
    {
        $this->userProfile = $userProfile;
        $this->options = $options;
    }
}
