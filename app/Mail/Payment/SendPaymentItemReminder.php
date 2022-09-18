<?php

namespace App\Mail\Payment;

use App\DbModels\Reminder;
use App\DbModels\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPaymentItemReminder extends Mailable
{
    use SerializesModels;
    /**
     * @var Reminder
     */
    public $reminder;

    /**
     * @var User
     */
    public $user;

    public $details;

    /**
     * Create a new message instance.
     *
     * @param Reminder $reminder
     * @param User $user
     * @param $details
     */
    public function __construct(Reminder $reminder, User $user, $details)
    {
        $this->reminder = $reminder;
        $this->user = $user;
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reminder = $this->reminder;
        $property = $this->reminder->property;
        $user = $this->user;
        $details = $this->details;
        $payment = $details->payment;
        $paymentType = $payment->paymentType;
        $paymentDetailsPage = $property->getPropertyLink() . config('app.resident_portal_payment_center_url_prefix') . '/payment/' . $payment->id;
        return $this->subject("Reminder from {$property->title} community")->view('payment.send-payment-item-reminder.index')
            ->with(['reminder' => $reminder, 'paymentDetailsPage' => $paymentDetailsPage, 'property' => $property, 'user' => $user, 'details' => $details, 'payment' => $payment, 'paymentType' => $paymentType]);
    }
}
