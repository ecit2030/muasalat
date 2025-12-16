<?php

namespace App\Http\Controllers\Api\Captain;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Captain\Wallet\StoreWalletRequest;
use App\Http\Resources\Api\Captain\Wallet\WalletResource;
use App\Models\UserWithdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WalletController extends ApiController
{
    function walletPage(Request $request)
    {
        $general = setting('general');
        $appPercentage = +data_get($general, "appPercentage");
        $data = [
            "appPercentage" => (int)$appPercentage,
            "balance" => auth()->user()->balance,
            "suspendedBalance" => (double)auth()->user()->withdraws()->whereStatus("pending")->sum("user_withdraws.balance"),
            "canSendWithdrawOrder" => true,
        ];
        return sendResponse($data);
    }

    function walletWithDraws(Request $request)
    {
        return sendResponse(WalletResource::collection(auth()->user()->withdraws));
    }

    function walletWithDrawOrder(StoreWalletRequest $request)
    {
        if (UserWithdraw::whereUserId(auth()->id())->whereStatus('pending')->exists())
            return sendError(__('Already has ongoing request'));

        auth()->user()->withdraws()->create($request->validated());

        auth()->user()->update([
            "balance" => auth()->user()->balance - $request->balance
        ]);

        return sendResponse(__("messages.resource_created"));
    }
}
