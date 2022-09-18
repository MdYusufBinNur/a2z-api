<?php


namespace App\Services\PaymentServices;

use Illuminate\Support\Facades\URL;

class PaymentByAamarPay
{
    public static function pay(array $data, string $providerName){
        $url = 'https://sandbox.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php

        $successSignedUrl = URL::temporarySignedRoute('aamarpay-payment-transaction-success', now() -> addMinutes(3), ['paymentId' => $data['paymentId'], 'name' => 'payment']);
        $failedSignedUrl = URL::temporarySignedRoute('aamarpay-payment-transaction-failed', now() -> addMinutes(3), ['paymentId' => $data['paymentId'], 'name' => 'payment']);

        $fields = array(
            'store_id' => 'aamarpay', //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
            'amount' => $data['amount'], //transaction amount
            'payment_type' => 'VISA', //no need to change
            'currency' => 'BDT',  //currenct will be USD/BDT
            'tran_id' => $data['refId'], //transaction id must be unique from your end
            'cus_name' =>  $data['customerName'],  //customer name
            'cus_email' =>  $data['customerEmail'], //customer email address
            'cus_add1' => $data['customerAddress'],  //customer address
            'cus_add2' => $data['customerAddress'], //customer address
            'cus_city' => 'Default',  //customer city
            'cus_state' => 'Default',  //state
            'cus_postcode' => '1206', //postcode or zipcode
            'cus_country' => 'Bangladesh',  //country
            'cus_phone' => $data['customerPhone'], //customer phone number
            'cus_fax' => 'Not¬Applicable',  //fax
            'ship_name' => 'ship name', //ship name
            'ship_add1' => 'House B-121, Road 21',  //ship address
            'ship_add2' => 'Mohakhali',
            'ship_city' => 'Dhaka',
            'ship_state' => 'Dhaka',
            'ship_postcode' => '1212',
            'ship_country' => 'Bangladesh',
            'desc' => 'payment description',
            'success_url' => $successSignedUrl,
            'fail_url' => $failedSignedUrl,
            'cancel_url' => $data['callbackURL'],
            'opt_a' => $data['invoice'],  //invoice number for tracking order payment
            'opt_b' => $data['paymentId'],  //paymentId number for tracking order payment
            'opt_c' => $data['refId'],  //refId for tracking payment item
            'opt_d' => $providerName,  //providerName for tracking provider
            'signature_key' => '28c78bb1f45112f5d40b956fe104645a' //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key
        );

        $fields_string = http_build_query($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);

        $url_forward = json_decode($result, true);
        curl_close($ch);

        $gatewayPageURL = 'https://sandbox.aamarpay.com' . $url_forward;

        return ['GatewayPageURL' => $gatewayPageURL, 'status' => 'success'];
    }


}
