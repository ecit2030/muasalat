<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Datatables\Dashboard\User\ChatDatatable;
use App\Datatables\Dashboard\User\UserDatatable;
use App\Enums\Transaction\TransactionReasonEnum;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\User\UsersRequest;
use App\Models\User;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.user.users';

    protected string $datatable = UserDatatable::class;
    protected string $formRequest = UsersRequest::class;

    protected string $permissions = 'user';

    protected string $model = User::class;
    public function show($id)
    {
        $model = User::findOrFail($id);

        return view($this->routeName . '.show', compact('model'));
    }

    protected function storeAction(array $validated)
    {
        $model = $this->queryBuilder()->create($validated);

        if (isset($validated['avatar'])) {
            $model->clearMediaCollection('avatar');
            $model->addMedia(Arr::pull($validated, 'avatar'))->toMediaCollection('avatar');
        }
    }

    protected function updateAction(array $validated, Model $model)
    {
        $model->update($validated);

        if (isset($validated['avatar'])) {
            $model->clearMediaCollection('avatar');
            $model->addMedia(Arr::pull($validated, 'avatar'))->toMediaCollection('avatar');
        }
    }


    public function activation(Request $request)
    {
        $model = $this->model::findOrFail($request->model_id);
        $model->is_active = !$model->is_active;
        $model->save();
        return redirect()->route($this->routeName . '.index');
    }

    public function getUserBalance(Request $request)
    {
        $user = User::find($request->id);
        return [
            'balance' => $user?->wallet()->sum('steps')
        ];
    }

    public function updateUserBalance(Request $request)
    {
        $request->validate(['amount' => 'required|numeric']);
        $user = User::find($request->id);
        $user?->walletType(
            'money',
            transactionType: $request->type =='depositBalance' ? 'deposit' : 'withdrawal',
        )->walletTransactionReason(TransactionReasonEnum::management_update_balance()->value)
            ->walletSteps($request->amount)
            ->walletCreate();

        return [
            'balance' => $user?->wallet()->sum('steps')
        ];
    }


    protected function formData(?Model $model = null): array
    {
        return [
            'phone' => $model?->info?->phone,
            'selected' => $model?->getRoleNames(),
            'avatar' => $model?->getFirstMediaUrl('avatar'),
        ];
    }
}
