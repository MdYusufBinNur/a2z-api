<?php

namespace App\Listeners\UserAccountLog;

use App\DbModels\UserAccountLog;
use App\Events\UserAccountLog\UserAccountLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\UserAccountRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserAccountLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * HandleOrderUpdatedEvent constructor.
     * @param UserAccountRepository $userAccountRepository
     */
    public function __construct(UserAccountRepository $userAccountRepository)
    {
        $this->userAccountRepository = $userAccountRepository;
    }

    /**
     * Handle the event.
     *
     * @param UserAccountLogCreatedEvent $event
     * @return void
     */
    public function handle(UserAccountLogCreatedEvent $event)
    {
        $userAccountLog = $event->userAccountLog;
        $eventOptions = $event->options;
        $userAccount = $userAccountLog->userAccount;

        if($userAccountLog->type == UserAccountLog::TYPE_CASHBACK) {
            if($userAccountLog->method == UserAccountLog::METHOD_IN) {
                $userAccountData['cashbackAmount'] = $userAccount->casbackAmount + $userAccountLog->amount;
            } else {
                $userAccountData['cashbackAmount'] = $userAccount->casbackAmount - $userAccountLog->amount;
            }

            $this->userAccountRepository->update($userAccount, $userAccountData);
        }

    }
}
