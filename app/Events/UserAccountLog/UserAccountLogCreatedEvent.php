<?php

namespace App\Events\UserAccountLog;


use App\DbModels\UserAccountLog;
use Illuminate\Queue\SerializesModels;

class UserAccountLogCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserAccountLog
     */
    public $userAccountLog;

    /**
     * Create a new event instance.
     *
     * @param UserAccountLog $userAccountLog
     * @param array $options
     */
    public function __construct(UserAccountLog $userAccountLog, array $options = [])
    {
        $this->userAccountLog = $userAccountLog;
        $this->options = $options;
    }
}
