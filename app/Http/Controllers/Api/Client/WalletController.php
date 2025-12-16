<?php

namespace App\Http\Controllers\Api\Client;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Enums\Transaction\TransactionReasonEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\Wallet\WalletResource;
use App\Models\User;
use App\Notifications\FcmNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class WalletController extends Controller
{

    public function index()
    {
        return sendResponse(WalletResource::collection(
            auth()->user()?->wallet()->orderByDesc('created_at')->get()
        ));
    }

    public function balance()
    {
        return sendResponse([
            'balance' => auth()->user()?->wallet()->sum('steps')
        ]);
    }

    public function chargeWallet(Request $request)
    {
        $request->validate(['balance' => ['required'], 'payment_method_id' => ['required']]);

        $invoice_number = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
        $transactionData['invoice_number'] = $invoice_number;
        $transactionData['type'] = 'charge_wallet';

        $transaction = auth()->user()?->transactions()->create([
            'pay_data' => $transactionData,
            'pay_id' => Str::uuid(),
            'payment_method' => 'online',
            'amount' => $request->balance,
            'transaction_reasons' => 'charge_wallet',
            'status' => 'not_paid',
        ]);


        $checkout = new \App\Services\Payment();
        return $checkout->getCheckout($transaction, $request->payment_method_id, $scheduled_invoice = 0);

//        $response = myFatoorahTransaction(
//            data: ['transaction_reason' => TransactionReasonEnum::USER_CHARGE_WALLET],
//            amount: $request->balance
//        );

//        return sendResponse(message: __("messages.wallet charged successfully"));
    }
}
