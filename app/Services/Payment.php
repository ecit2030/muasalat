<?php

namespace App\Services;


use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Enums\Transaction\TransactionReasonEnum;
use App\Models\CardPaymentMethod;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\Trip;
use App\Models\User;
use App\Notifications\FcmNotification;


class Payment
{
    protected $link;
    protected $token;

    public function __construct()
    {
//        if (env('APP_ENV') == 'local') {
//            $this->link = env('TEST_PAYMENT_LINK');
//            $this->token = env('TEST_ACCESS_TOKEN');
//        } else {
//            $this->link = env('LIVE_PAYMENT_LINK');
//            $this->token = env('LIVE_ACCESS_TOKEN');
//        }
        $this->link = env('LIVE_PAYMENT_LINK');
        $this->token = env('LIVE_ACCESS_TOKEN');
    }

    public function getIntityId($brand)
    {
//        if (env('APP_ENV') == 'local') {
//            return env('Test_' . $brand . '_Entity_ID');
//        } else {
//            return env('Live_' . $brand . '_Entity_ID');
//        }
        return env('Live_' . $brand . '_Entity_ID');
    }


    public function getCheckout($transaction, $payment_method_id, $scheduled_invoice, $amount = 0)
    {
        $payment_method = CardPaymentMethod::find($payment_method_id);

            // ---------- TEST MODE ----------
            // Set this to true to bypass real payment API
            $testMode = true;
            if ($testMode) {
                // Generate fake payment data
                $res['check_id'] = 'TEST-' . \Str::uuid();
                $res['integrity'] = 'TEST_HASH';
                $res['payment_method'] = $payment_method->payment;
                $res['invoice_id'] = $transaction->id;
                $res['scheduled_invoice'] = (int)$scheduled_invoice;
                $res['entityId'] = 'TEST_ENTITY';  

                // Fake payment link (optional)
                $res['payment_link'] = url('admin/hyperPay/' . $transaction->id . '/' . $payment_method->id . '/' . $scheduled_invoice . '?hash=TEST_HASH');

                // Update transaction table as “not_paid” or “paid” depending on what you want
                $transaction?->update([
                    'pay_id' => $res['check_id'],
                    'payment_method' => $payment_method->payment,
                    'status' => 'paid',
                    'amount' => round($transaction->amount, 2) ,
                    'paid_at' => now(),
                ]);

                return $res;
            }
            // ---------- END TEST MODE ----------

            // ---------- ORIGINAL CODE (real payment) ----------
        $brand = in_array($payment_method->payment, ['VISA', 'MASTER']) ? 'DEFAULT' : $payment_method->payment;
        $entityId = $this->getIntityId($brand);
        $url = $this->link . "/v1/checkouts";
        $verfiy = env('APP_ENV') == 'local' ? false : true;

        $data = "entityId=" . $entityId .
            "&amount=" . round($transaction->amount, 2) .
            "&currency=SAR" .
            "&paymentType=DB" .
            "&integrity=true" .
            "&merchantTransactionId=" . $transaction->id .
            "&shopperResultUrl=" . urlencode(route('dashboard.hyperPay.callback')) .  // Redirect URL for user
            "&customer.email=user@gmail.com" .
            "&customer.givenName=user" .
            "&customer.surname=user" .
            "&billing.country=SA" .
            "&billing.street1= street" .
            "&billing.city= Buraydah" .
            "&billing.state= Qassim" .
            "&billing.postcode=966";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . $this->token,
            'Content-Type: application/x-www-form-urlencoded' // Add this
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verfiy);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }

        curl_close($ch);
        info('HEREEEEEEEEE.........');
        info($responseData);
        $responseData = json_decode($responseData);

        if ($responseData && !(isset($responseData->id))) {
            throw new \Exception('Payment Error');
        }

        $res['check_id'] = $responseData->id;
        $res['integrity'] = $responseData->integrity;
        $res['payment_method'] = $payment_method->payment;
        $res['invoice_id'] = $transaction->id;
        $res['scheduled_invoice'] = (int)$scheduled_invoice;

        $transaction?->update([
            'pay_id' => $responseData->id,
            'payment_method' => $payment_method->payment,
        ]);

        $res['payment_link'] =
            url('admin/hyperPay/' . $transaction->id . '/' . $payment_method->id . '/' . $scheduled_invoice . '?hash=' . $responseData->integrity);
        $res['entityId'] = $entityId;

        return $res;
    }

    public function checkPayment($data, $brand = null)
    {
        // dd($data);
        try {
            $checkout_id = $data['id'];
            $invoice = Transaction::where('pay_id', $checkout_id)->firstOrFail();

            $brand = in_array($invoice->payment_method, ['VISA', 'MASTER']) ? 'DEFAULT' : $invoice->payment_method;
            $verfiy = env('APP_ENV') == 'local' ? false : true;
            $entityId = $this->getIntityId($brand);

            $url = $this->link . $data['resourcePath'];
            $url .= "?entityId=" . $entityId;
            $verifySsl = env('APP_ENV') === 'production';

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $this->token
                ],
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_SSL_VERIFYPEER => $verifySsl,
                CURLOPT_RETURNTRANSFER => true
            ]);

            $responseData = curl_exec($ch);
            $responseData = json_decode($responseData);
            $code = optional($responseData->result)->code ?? null;

            $integrity = $responseData->integrity ?? null;
            if (curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);
            $successCodePattern = '/^(000\.000\.|000\.100\.1|000\.[36])/';
            $successManualReviewCodePattern = '/^(000\.400\.0|000\.400\.100)/';

            //success status

            $base_url = env('APP_ENV') == 'local' ? env('TEST_FRONTEND_BASE_URL') : env('FRONTEND_BASE_URL');
            if (preg_match($successCodePattern, $code) || preg_match($successManualReviewCodePattern, $code)) {
                if ($invoice->pay_data['type'] == 'charge_wallet') {
                    $this->chargeWallet($invoice);
                } elseif ($invoice->pay_data['type'] == 'pay_trip') {
                    $this->payTrip($invoice);
                }

                $invoice = $invoice->fresh();
                $invoice->status = 'paid';
                $invoice->paid_at = now();
                $invoice->pay_id = $responseData->id;
                $invoice->save();

                $redirectUrl = $base_url . 'modules/checkout/pay?invoice_id=' . $responseData->merchantTransactionId .
                    '&payment_status=success&paid=1';
                return [
                    'status' => 200,
                    'paid' => true,
                    'msg' => '',
                    'brand' => $invoice->payment_method,
                    'invoice_id' => $responseData->merchantTransactionId,
                    'redirectUrl' => $redirectUrl,
                    'integrity' => $integrity,
                ];
            } else {
                $redirectUrl = $base_url .
                    'modules/checkout/pay?payment_status=failed&paid=0';

                return [
                    'status' => 400,
                    'paid' => false,
                    'msg' => optional($responseData->result)->description ?? null,
                    'brand' => $invoice->payment_method,
                    'invoice_id' => $responseData->merchantTransactionId ?? 0,
                    'redirectUrl' => $redirectUrl,
                    'integrity' => $integrity,
                ];
            }
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                ],
                400
            );
        }
    }

    private function chargeWallet($invoice)
    {
        $walletRecord = $invoice?->transactionable?->walletType(
            'money',
            transactionType: 'deposit',
        )->walletTransactionReason(TransactionReasonEnum::user_charge_wallet()->value)
            ->walletSteps($invoice->amount)
            ->walletCreate();

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        foreach ($admins as $admin) {
            $admin?->notify(new FcmNotification(
                $admin->sendableTokens,
                __("messages.user_charge_wallet"),
                __(
                    "messages.client :client charge wallet with amount :amount",
                    ['client' => $invoice?->transactionable?->name, 'amount' => $invoice->amount]
                ),
                FCMTopic::DRIVER_TRIP_BOOKED,
                FCMAction::DRIVER_OPEN_UPCOMING_TRIPS,
                $walletRecord?->id,
            ));
        }
    }

    public function payTrip($invoice)
    {
        $trip = Trip::where('id', $invoice->pay_data['trip_id'])->firstOrFail();

        $trip->report()?->update(['payment_method' => 'credit', 'is_paid' => 1, "accepted_time" => null]);

        $trip->driver?->notify(new FcmNotification(
            $trip->driver?->sendableTokens,
            [
                'ar' => __("messages.you_have_new_notification", [], 'ar'),
                'en' => __("messages.you_have_new_notification", [], 'en')
            ],
            [
                'ar' => __("messages.client pay trip :trip", ['trip' => $trip->id], 'ar'),
                'en' => __("messages.client pay trip :trip", ['trip' => $trip->id], 'en')
            ],
            FCMTopic::DRIVER_TRIP_BOOKED,
            FCMAction::DRIVER_OPEN_PREVIOUS_TRIPS,
            $trip?->id,
        ));

    }


}
