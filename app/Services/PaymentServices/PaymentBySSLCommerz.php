<?php


namespace App\Services\PaymentServices;

use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Http\JsonResponse;

class PaymentBySSLCommerz
{
    /**
     * Display a listing of the resource.
     *
     * @param array $data
     * @return JsonResponse
     */
    public static function pay(array $data)
    {
        $post_data['total_amount'] = $data['amount'] ? $data['amount'] : 10;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $data['invoice'] ? $data['invoice'] : '100'; // tran_id must be unique
        $post_data['product_category'] = 'default'; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $data['customerName'];
        $post_data['cus_email'] = $data['customerEmail'];
        $post_data['cus_add1'] = $data['customerAddress'];
        $post_data['cus_add2'] = $data['customerAddress'];
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_city'] = "Default";
        $post_data['cus_phone'] = $data['customerName'];
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $data['customerPhone'];
        $post_data['cus_postcode'] = '4340';

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        return ['GatewayPageURL' => $payment_options['GatewayPageURL'], 'status' => $payment_options['status']];
        // return redirect($redirectUrl);
    }
}
