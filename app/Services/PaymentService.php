<?php

namespace App\Services;

//use Devinweb\LaravelHyperpay\Facades\LaravelHyperpay;
use Devinweb\LaravelHyperpay\Facades\LaravelHyperpay;
use App\Billing\HyperPayBilling;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PaymentService
{
    protected $testUrl = "https://test.oppwa.com";
    protected $testUrl2 = "https://eu-test.oppwa.com/"; // from customer file
    protected $liveUrl = "https://oppwa.com";
    protected $accessToken = "OGFjN2E0Yzk4M2IzMDZiZDAxODNiZTI4MGJlOTZkOTd8eEtTbXczNHlqWA==";

//    public function prepareTheCheckout($amount)
//    {
//        $url = "$this->testUrl2/v1/checkouts";
//        $currency = config('hyperpay.currency');
//        $paymentType = config('hyperpay.paymentType');
//        $entityId = config('hyperpay.entityId');
//        $data = "entityId=$entityId" .
//            "&amount=$amount" .
//            "&currency=$currency" .
//            "&paymentType=$paymentType";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
////        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
////            'Authorization:Bearer OGE4Mjk0MTc0ZDA1OTViYjAxNGQwNWQ4MjllNzAxZDF8OVRuSlBjMm45aA=='));
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            "Authorization:Bearer OGFjN2E0Yzk4M2IzMDZiZDAxODNiZTI4MGJlOTZkOTd8eEtTbXczNHlqWA=="));
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $responseData = curl_exec($ch);
//        if (curl_errno($ch)) {
//            return curl_error($ch);
//        }
//        curl_close($ch);
//
//        return $responseData;
//    }
//
//    public function getThePaymentStatus($checkoutId)
//    {
//
//        $entityId = config('hyperpay.entityId');
//        $url = "$this->testUrl/v1/checkouts/$checkoutId/payment";
//        $url .= "?entityId=$entityId";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            "Authorization:Bearer $this->accessToken"));
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $responseData = curl_exec($ch);
//        if (curl_errno($ch)) {
//            return curl_error($ch);
//        }
//        curl_close($ch);
//        return $responseData;
//    }


    public function prepareCheckout($data)
    {
//        $redirect_url = route('stores.subscribtions.index');
        $redirect_url = route('payFormStatus');
        $id = Str::random('64');
        $currency = config('hyperpay.currency');
        $paymentType = config('hyperpay.paymentType');
        $entityId = config('hyperpay.entityId');

        $user = auth()->user()?? $data['user'];
        $amount = $data['price']?? 0;
        $brand = 'VISA'; // MASTER OR MADA
        $data['entityId'] = $entityId;
        $data['currency'] = $currency;
        $data['paymentType'] = $paymentType;
//        $data['merchantTransactionId']=$user->id;
//        $data['customer.email']=$user->email?? '';
//        $data['billing.street1']=$request->street1?? '';
//        $data['billing.city']=$request->city?? '';
//        $data['billing.state']=$request->state?? '';
//        $data['billing.country']=$request->country?? '';
//        $data['billing.postcode']=$request->postcode?? '';
//        $data['customer.givenName']=$request->givenName?? '';
//        $data['customer.surname']=$request->surname?? '';

        $request = new Request($data);
        return LaravelHyperpay::addRedirectUrl($redirect_url)->addMerchantTransactionId($id)->addBilling(new HyperPayBilling())->checkout($data, $user, $amount, $brand, $request);
//        return LaravelHyperpay::addRedirectUrl($redirect_url)->addMerchantTransactionId($id)->addBilling(new HyperPayBilling())->checkout($data, $user, $amount, $brand, $request);
    }

    public function paymentStatus(Request $request)
    {
        $resourcePath = $request->get('resourcePath');
        $checkout_id = $request->get('id');
        return LaravelHyperpay::paymentStatus($resourcePath, $checkout_id);
    }
}
