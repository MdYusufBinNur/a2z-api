<?php

namespace App\Listeners\User;

use App\Events\User\UserLoggedInEvent;
use App\Repositories\Contracts\UserRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserLoggedInEvent implements ShouldQueue
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * HandleUserLoggedInEvent constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the event.
     *
     * @param UserLoggedInEvent $event
     * @return void
     */
    public function handle(UserLoggedInEvent $event)
    {
        $user = $event->user;

        // update last login time
        $this->userRepository->update($user, ['lastLoginAt' => Carbon::now()]);
    }
}
