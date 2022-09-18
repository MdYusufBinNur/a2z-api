<?php

namespace App\Listeners\User;

use App\DbModels\PasswordReset;
use App\DbModels\UserAccount;
use App\Events\User\UserCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Repositories\Contracts\UserAccountRepository;
use App\Repositories\Contracts\UserProfileRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserCreatedEvent  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        $user = $event->user;
        $eventOptions = $event->options;

        $userAccount['userId'] = $user->id;
        $userAccount['status'] = UserAccount::STATUS_ACTIVE;
        $userAccountRepository = app(UserAccountRepository::class);
        $userAccountRepository->save($userAccount);

        $userProfileRepository = app(UserProfileRepository::class);
        $userProfileRepository->save(['userId' => $user->id]);

        // send reset password email
//        $passwordResetRepository = app(PasswordResetRepository::class);
//        $passwordResetRepository->save(['userId' => $user->id, 'type' => PasswordReset::TYPE_SET_PASSWORD_BY_PIN]);

    }
}
