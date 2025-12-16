<?php

namespace App\Http\Controllers;


use App\Models\CardPaymentMethod;
use App\Models\Transaction;
use App\Models\Trip;
use App\Services\Payment;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function viewForm(Request $request)
    {
        $integrity = request()->get('hash');
        $transactionId = request()->segment(count(request()->segments()) - 2);
        $paymentMethodID = request()->segment(count(request()->segments()) - 1);
        $scheduled_invoice = request()->segment(count(request()->segments()));
        $paymentMethod = CardPaymentMethod::where('active', 1)->findOrFail($paymentMethodID);
        $invoice = Transaction::find($transactionId);
        $integrity = str_replace(' ', '+', $integrity);
//        $Rollback = url('admin/hyperPay/' . $transactionId . '/' . $paymentMethodID . '/' . $scheduled_invoice . '?hash='.$integrity);
        return view('payment', compact('invoice', 'transactionId', 'paymentMethod','integrity'));
    }

    public function callback(Request $request)
    {
        if ($request->id && $request->resourcePath) {
            $data = [
                'id' => $request->id,
                'resourcePath' => $request->resourcePath,
                'invoiceID' => $request->invoiceID,
                'scheduled_invoice' => $request->scheduled_invoice,
            ];
            $payment_status = new Payment();
            $payment_status = $payment_status->checkPayment($data);

            $callback = $payment_status['redirectUrl'];

            $payment_status = json_decode(json_encode($payment_status, true));
            $callback_success = $payment_status->redirectUrl;
            $integrity = $payment_status->integrity;


            if ((isset($callback) && $callback) || (isset($callback_success) && $callback_success)) {
                return redirect($callback_success);
                // return response()->json([
                //     'status' => true,
                //     'message' => 'success',
                //     'data' => $payment_status,
                // ]);

            } else {
                $payment_status = json_encode($payment_status, true);
                return redirect(url('https://muasalat.net'));
            }
        }
        return redirect(url('https://muasalat.net'));

    }

}
