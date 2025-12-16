<?php

namespace App\Http\Controllers\Dashboard\General\Administration;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Datatables\Dashboard\General\Administration\RolesDatatable;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Administration\RoleRequest;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Notifications\FcmNotification;
use App\Support\Crud\WithCrud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RoleController extends DashboardController
{
    use WithCrud;

    protected string $routeName = 'dashboard.general.administration.roles';

    protected string $model = Role::class;

    protected string $datatable = RolesDatatable::class;

    protected string $permissions = 'role';

    protected function formData(?Model $model = null): array
    {
        $admin = auth()->user()->hasRole("admin");

        if ($admin) {

            $permissions = Permission::whereGuardName('dashboard')->get();
            $modules = Module::whereGuardName('dashboard')->get();
        } else {
            $orgPermissions = User::orgPermissions;

            $permissions =  Permission::where(function ($q) use ($orgPermissions) {
                $q->where("name", "LIKE", '%' . array_keys($orgPermissions)[0]);
                foreach ($orgPermissions as $key => $value) {
                    $q->orWhere("name", "LIKE", '%' . $key);
                    foreach ($value as $permission) {
                        $q->where("name", "!=", $permission . "_" . $key);
                    }
                }
            })->get();

            $modules =  Module::whereIn("id", $permissions->unique("module_id")->pluck("module_id")->toArray())->get();
        }

        return ([
            'permissions' => $permissions,
            'modules' => $modules,
        ]);
    }

    protected function storeAction(array $validated)
    {

        $moderator = auth()->user()->hasRole("moderator");
        $organization = auth()->user()->hasRole("organization");

        if ($moderator) {
            $validated["owner_id"] = auth()->user()->organization_id;
        }

        if ($organization) {
            $validated["owner_id"] = auth()->id();
        }

        $permissions = Arr::pull($validated, 'permissions');

        $validated['guard_name'] = 'dashboard';
        $role = Role::create($validated);
        $role->syncPermissions($permissions);
    }

    protected function updateAction(array $validated, Model $model)
    {
        $model->syncPermissions(Arr::pull($validated, 'permissions', []));
        $model->update($validated);

        $admins = User::role($model->name)->get();

        foreach ($admins as $admin) {
            $tokens = $admin->sendableTokens;
            $admin->notify(new FcmNotification($tokens, __("messages.the_role_you_own_has_been_updated"), __("messages.some_admin_make_change_to_role") . " " . $model->name,FCMTopic::ADMIN_ROLE_UPDATED,FCMAction::NO_ACTION));
        }
    }


    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);
        $check = User::role($model->name)->count();

        if ($check == 0) {
            $this->code = 200;
            $this->message = t_('Data has been deleted successfully');
            $action = $this->destroyAction($model);
            return $action ?? $this->successfulRequest(asJson: true);
        };

        $this->code = 400;
        $this->message = t_('cant deleted this record') . " " . t_("there_is_one_or_more_admin_has_this_role");

        return $action ?? $this->successfulRequest(asJson: true);
    }

    protected function validationAction(): array
    {
        return app(RoleRequest::class)->validated();
    }

    
    public function activation(Request $request)
    {
        $model = $this->model::query()->findOrFail($request->model_id);

        $model->is_active = !$model->is_active;
        if ($model->is_active) {
            $message = t_("your account has been deactivated");
        } else {
            $message = t_("your account has been activated");
        }
        $model->save();

        return redirect()->route($this->routeName . '.index');
    }
}
