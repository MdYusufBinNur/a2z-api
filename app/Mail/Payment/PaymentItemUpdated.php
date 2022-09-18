<?php

namespace App\Mail\Payment;

use App\DbModels\PaymentItem;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentItemUpdated extends Mailable
{
    use SerializesModels;

    /**
     * @var PaymentItem
     */
    public $paymentItem;

    /**
     * @var PaymentItem
     */
    public $contactName;

    /**
     * Create a new message instance.
     *
     * @param PaymentItem $paymentItem
     * @param string $contactName
     * @return void
     */
    public function __construct(PaymentItem $paymentItem, string $contactName)
    {
        $this->paymentItem = $paymentItem;
        $this->contactName = $contactName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //todo attach invoice pdf

        $paymentItem = $this->paymentItem;
        $payment = $paymentItem->payment;
        $paymentType = $payment->paymentType;

        $subject = "Invoice - " . $payment->paymentType->title;

        return $this->subject($subject)->view('payment.status-change-notification.index')
            ->with([
                'contactName' => $this->contactName,
                'property' => $paymentItem->property,
                'paymentItem' => $paymentItem,
                'payment' => $payment,
                'paymentType' => $paymentType,
            ]);
    }
}
