<?php


namespace App\Services\PaymentServices;

use App\DbModels\Payment;
use App\DbModels\PaymentItem;
use App\DbModels\PaymentMethod;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PaymentHelper
{
    /**
     * generate payment link
     *
     * @param array $data
     * @return string[]
     */
    public static function generatePaymentLink(array $data)
    {
        $currentUser = Auth::user();
        $providerName = $data['providerName'];

        $paymentData = [
            'invoice' => $data['invoice'],
            'refId' => $data['refId'],
            'paymentId' => $data['paymentId'],
            'appName' => config('app.brand_site'),
            'cartInfo' => 'Payment by ' . $currentUser->name . '(' . $currentUser->id . ')',
            'customerName' => $currentUser->name,
            'customerEmail' => $currentUser->email,
            'customerAddress' => 'Dhaka',
            'customerPhone' => $currentUser->phone,
            'productDescription' => 'Payment of ' . $data['invoice'] .' amount : ' . $data['amount'],
            'amount' => $data['amount'],
            'currency' => 'BDT',
            'options' => 'cz1yZWZvcm1lZHRlY2gub3JnLGk9MTkyLjE2OC41LjI=',
            'callbackURL' => config('app.pgw_callback_url') . $data['invoice']
        ];

        if($providerName === PaymentMethod::TITLE_NAGAD) {
            return PaymentByNagad::pay($paymentData);
        }
        else if ($providerName === PaymentMethod::TITLE_SSL_COMMERZ) {
            return PaymentBySSLCommerz::pay($paymentData);
        }
        else if ($providerName === PaymentMethod::TITLE_AAMAR_PAY) {
            return PaymentByAamarPay::pay($paymentData, $providerName);
        } else {
            return ['GatewayPageURL' => '', 'status' => 'failed'];;
        }
    }
}
