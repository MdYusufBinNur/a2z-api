<?php


namespace App\Services\Helpers;

use App\DbModels\Payment;
use App\DbModels\User;
use App\Services\SMS\SMS;

class SmsHelper
{
    /**
     * send registration pin
     *
     * @param User $user
     * @param int $pin
     */
    public static function sendRegistrationPin(User $user, int $pin)
    {
        $smsService = app(SMS::class);
        $phone = $user->phone;
        if (!empty($phone)) {
            $smsService->send($phone, 'Your pin to complete the registration at ' . config('app.name') . ': ' . $pin);
        }

    }

    /**
     * send service request assigned notification sms
     *
     * @param string|null $toPhone
     * @param Payment $payment
     */
    public static function sendPaymentNotification(Payment $payment, $toPhone)
    {
        $smsService = app(SMS::class);
        if (!empty($toPhone)) {
            $text = "You have a due invoice ref#{$payment->invoice}. Please pay.";
            $smsService->send($toPhone, $text);
        }

    }
}
