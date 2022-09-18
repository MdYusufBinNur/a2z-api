<?php

namespace App\Policies;

use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
