<?php

namespace App\Http\Controllers\Dashboard\General\Administration;

use App\Datatables\Dashboard\General\Administration\AdminsDatatable;
use App\Enums\General\RolesEnum;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Administration\AdminRequest;
use App\Models\Role;
use App\Models\User;
use App\Notifications\FcmNotification;
use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Mail;
use Modules\Code\Services\EmailService;

class AdminController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.general.administration.admins';

    protected string $datatable = AdminsDatatable::class;

    protected string $permissions = 'administration';

    protected string $model = User::class;

    public function show($id)
    {
        $model = User::findOrFail($id);
        return view($this->routeName . '.show', compact('model'));
    }

    protected function storeAction(array $validated)
    {
        $avatar = Arr::pull($validated, 'avatar');

        $roles = Arr::pull($validated, 'roles', []);
        $model = $this->queryBuilder()->create($validated);
        $avatar && uploadMedia('avatar', $avatar, $model);

        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            $roles[] = RolesEnum::admin()->value;
        }
        if ($organization) {
            $roles[] = RolesEnum::moderator()->value;
            $model->organization_id = auth()->id();
            $model->save();
        }
        if ($moderator) {
            $roles[] = RolesEnum::moderator()->value;
            $model->organization_id = auth()->user()->organization_id;
            $model->save();
        }
        $model->syncRoles($roles);

        $email = new EmailService();
        $email->sendRandomPassword($model->email, t_("welcome_in_musasalat"), t_("You_password_is"), $validated["password"]);
    }

    protected function updateAction(array $validated, Model $model)
    {
        $avatar = Arr::pull($validated, 'avatar');

        $avatar && uploadMedia('avatar', $avatar, $model);

        $roles = Arr::pull($validated, 'roles', []);
        // $roles[] = RolesEnum::admin()->value;
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {
            // $roles[] = RolesEnum::admin()->value;
            $roles[] = RolesEnum::moderator()->value;
        }
        if ($organization) {
            $roles[] = RolesEnum::moderator()->value;
            $model->organization_id = auth()->id();
            $model->save();
        }
        if ($moderator) {
            $roles[] = RolesEnum::moderator()->value;
            $model->organization_id = auth()->user()->organization_id;
            $model->save();
        }

        $oldOtherPrice = $model->other_price ?? 0;
        $oldTalebatPrice = $model->talebat_price ?? 0;
        $model->update($validated);
        if (is_array($roles) && in_array('organization', $roles)) {
            if ($validated['other_price'] != $oldOtherPrice || $validated['talebat_price'] != $oldTalebatPrice) {
                $drivers = User::whereIsActive(1)->whereStatus('active')->whereOrganizationId(auth()->id())->with(['deviceTokens'])->get();
                foreach ($drivers as $driver) {
                    $tokens = $driver->sendableTokens;
                    $driver->notify(new FcmNotification($tokens, __("Organization prices changed should update"), __("Organization prices changed should update"), FCMTopic::ORGANIZATION_CHANGED_PRICE, FCMAction::DRIVER_CHANGE_PRICE));
                    $driver->update([
                        'update_price' => 1,
                    ]);
                }
            }
        }
        $model->syncRoles($roles);
    }


    public function activation(Request $request)
    {
        $model = $this->model::findOrFail($request->model_id);
        $model->is_active = !$model->is_active;
        if ($request->reason) {
            $model->reason = $request->reason;
            $message = t_("your account has been deactivated");
        } else {
            $message = t_("your account has been activated");
            $model->reason = "";
        }
        $model->save();

        $email = new EmailService();
        $email->activation(t_("dear, admin"), $message, $model->email, $request->reason);
        return redirect()->route($this->routeName . '.index');

    }

    protected function validationAction(): array
    {
        return app(AdminRequest::class)->validated();
    }

    protected function formData(?Model $model = null): array
    {
        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");
        $admin = auth()->user()->hasRole("admin");
        $super = auth()->user()->hasRole("super");

        if ($admin) {
            $data = Role::whereGuardName('dashboard')
                ->whereNotIn('name', RolesEnum::toArray())
                ->get(['id', 'name']);
        } elseif ($organization) {
            $data = Role::whereGuardName('dashboard')
                ->whereNotIn('name', RolesEnum::toArray())
                ->whereOwnerId(auth()->id())
                ->get(['id', 'name']);
        } elseif ($moderator) {
            $data = Role::whereGuardName('dashboard')
                ->whereNotIn('name', RolesEnum::toArray())
                ->whereOwnerId(auth()->user()->organization_id)
                ->get(['id', 'name']);
        }
        return [
            'jsValidator' => AdminRequest::class,
            'selected' => $model?->getRoleNames(),
            'roles' => toMap($data, 'name'),
        ];
    }
}
