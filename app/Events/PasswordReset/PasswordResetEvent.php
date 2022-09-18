<?php

namespace App\Events\PasswordReset;

use App\DbModels\PasswordReset;
use Illuminate\Queue\SerializesModels;

class PasswordResetEvent
{
    use SerializesModels;

    /**
     * @var PasswordReset
     */
    public $passwordReset;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param PasswordReset $passwordReset
     * @param array $options
     * @return void
     */
    public function __construct(PasswordReset $passwordReset, array $options = [])
    {
        $this->passwordReset = $passwordReset;
        $this->options = $options;
    }
}
