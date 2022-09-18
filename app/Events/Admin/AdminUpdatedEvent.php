<?php

namespace App\Events\Admin;

use App\DbModels\Admin;
use Illuminate\Queue\SerializesModels;

class AdminUpdatedEvent
{
    use SerializesModels;

    /**
     * @var Admin
     */
    public $admin;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Admin $admin
     * @param array $options
     * @return void
     */
    public function __construct(Admin $admin, array $options)
    {
        $this->admin = $admin;
        $this->options = $options;
    }
}
