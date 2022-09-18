<?php

namespace App\Mail\Payment;

use App\DbModels\PaymentItem;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvoice extends Mailable
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

        $subject = "Invoice - " . $paymentType->title;
        $paymentDetailsPage = $payment->property->getPropertyLink() . config('app.resident_portal_payment_center_url_prefix') . '/payment/' . $payment->id;

        return $this->subject($subject)->view('payment.send-invoice.index')
            ->with([
                'contactName' => $this->contactName,
                'property' => $paymentItem->property,
                'paymentItem' => $paymentItem,
                'payment' => $payment,
                'paymentType' => $paymentType,
                'paymentDetailsPage' => $paymentDetailsPage
            ]);
    }
}
