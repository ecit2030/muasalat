<?php

namespace App\Http\Controllers\Dashboard\Wallet;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Datatables\Dashboard\Wallet\WalletDatatable;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Wallet\StoreUserWithdrawRequest;
use App\Http\Requests\Dashboard\Wallet\StoreWalletRequest;
use App\Http\Requests\Dashboard\Wallet\UpdateWalletRequest;
use App\Models\User;
use App\Models\UserWithdraw;
use App\Models\Wallet;
use App\Notifications\FcmNotification;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Arr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class WalletController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.wallet.wallet';
    protected string $viewPath = 'dashboard.wallet.wallet';

    protected string $datatable = WalletDatatable::class;

    protected string $permissions = 'user_withdraw';

    protected string $model = UserWithdraw::class;

    public function show($id)
    {
        $wallet = $this->model::findOrFail($id);

        return view($this->routeName . '.show', compact('wallet'));
    }

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
        ]);
    }


    public function store(StoreUserWithdrawRequest $request )
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");

        if ($organization) {
            $user = auth()->user();
        } elseif ($moderator) {
            $user = User::findOrFail(auth()->user()->organization_id);
        }

        $this->model::create([
            "user_id" => $user->id,
            "balance" => $request->balance,
        ]);

        auth()->user()->update([
            "balance" => $user->balance - $request->balance
        ]);

        // admins
        $admins  = User::role("admin")->get();
        foreach ($admins as $admin) {
            $tokens  = $admin->sendableTokens;
            $admin->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"),  t_("organizations") . " " . $user->name . " " . t_("set a withdraw request by") . " " . $request->balance ),FCMTopic::ADMIN_WALLET_REQUEST,FCMAction::ADMIN_WALLET_REQUEST);
        }

        return redirect()->route($this->viewPath . ".index", ["status=pending"]);
    }

    public function accept(Request $request)
    {
        $model = $this->model::findOrFail($request->model_id);

        $model->update([
            "status" => "accepted",
            "admin_date" => Carbon::now()
        ]);

        $tokens  = $model->user->sendableTokens;
        $model->user->notify(new FcmNotification($tokens, __("messages.withdraw_accepted"), __("messages.admin_has_accepted_your_withdraw_has_value") . " " . $model->balance, FCMTopic::DRIVER_WALLET_REQUEST_ACCEPTED,FCMAction::DRIVER_WALLET_REQUEST_ACCEPTED));

        return redirect()->route($this->viewPath . ".index", ["status=pending"]);
    }

    public function decline(Request $request)
    {
        $model = $this->model::findOrFail($request->model_id);
        $model->update([
            "status" => "declined",
            "reason" => $request->reason,
            "admin_date" => Carbon::now()
        ]);

        $model->user->update([
            "balance" => $model->user->balance +  $model->balance
        ]);


        $tokens  = $model->user->sendableTokens;
        $model->user->notify(new FcmNotification($tokens, __("messages.withdraw_declined"), __("messages.admin_has_declined_your_withdraw_has_value") . " " . $model->balance,FCMTopic::DRIVER_WALLET_REQUEST_REJECTED,FCMAction::DRIVER_WALLET_REQUEST_REJECTED));

        return redirect()->route($this->viewPath . ".index", ["status=pending"]);
    }

    protected function formData(?Model $model = null): array
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $wallet = false;
            $balance = 0;
        } elseif ($organization) {
            $wallet = true;
            $balance = auth()->user()->balance;
        } elseif ($moderator) {
            $wallet = true;
            $balance = User::whereOwnerId(auth()->user()->organization_id)->wallet;
        }

        return [
            "model" => $model,
            "wallet" => $wallet,
            "balance" =>  $balance,
        ];
    }
}
