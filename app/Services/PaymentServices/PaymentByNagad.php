<?php


namespace App\Services\PaymentServices;

use Illuminate\Http\JsonResponse;
use NagadPayment;

class PaymentByNagad
{
    /**
     * Display a listing of the resource.
     *
     * @param array $data
     * @return array
     */
    public static function pay(array $data)
    {
        $redirectUrl = NagadPayment::tnxID($data['invoice'], true)
            ->amount($data['amount'])
            ->getRedirectUrl();

        return ['GatewayPageURL' =>$redirectUrl, 'status' =>'success'];
        //  return redirect($redirectUrl);
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public static function callback()
    {
        $verify = (object) NagadPayment::verify();
        if($verify->status === 'Success'){
            $order = json_decode($verify->additionalMerchantInfo);
            $oid = $order->tnx_id;
        }
        if ($verify->status === 'Aborted') {
            dd($verify);
        }
        dd($verify);
    }

}
