<?php

namespace App\Http\Controllers\Dashboard\Organization;

use App\Datatables\Dashboard\Organization\OrganizationDatatable;
use App\Enums\General\RolesEnum;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Organization\StoreOrganizationRequest;
use App\Http\Requests\Dashboard\Organization\UpdateOrganizationRequest;
use App\Http\Requests\Dashboard\Organization\UpdateOrganizationRequet;
use App\Models\User;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Modules\Code\Services\EmailService;

class OrganizationController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.organization.organization';

    protected string $datatable = OrganizationDatatable::class;
    protected string $formRequest = OrganizationRequest::class;

    protected string $permissions = 'organization';

    protected string $model = User::class;

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view($this->routeName . '.show', compact('user'));
    }


    protected function store(StoreOrganizationRequest $request)
    {
        $data = $request->validated();
        $roles[] = RolesEnum::organization()->value;

        $model = $this->queryBuilder()->create($data);
        $model->syncRoles($roles);

        if ($request->avatar) {
            $avatar = Arr::pull($data, 'avatar');
            $avatar && uploadMedia('avatar', $avatar, $model);
        }

        $logo = Arr::pull($data, 'logo');
        $logo && uploadMedia('logo', $logo, $model);

        $email = new EmailService();
        $email->sendRandomPassword($model["email"], t_("welcome_in_musasalat") , t_("You_password_is") , $request->password);


        return redirect()->route($this->routeName . ".index");
    }

    protected function update(UpdateOrganizationRequest $request, $id)
    {
        $model = User::findOrFail($id);
        $data = $request->validated();

        if ($request->avatar) {
            $avatar = Arr::pull($data, 'avatar');
            $avatar && uploadMedia('avatar', $avatar, $model);
        }

        $logo = Arr::pull($data, 'logo');
        $logo && uploadMedia('logo', $logo, $model);

        $roles[] = RolesEnum::organization()->value;

        $model->update($data);
        $model->syncRoles($roles);
        return redirect()->route($this->routeName . ".index");
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
        $email->activation(t_("dear, user") , $message , $model->email, $request->reason);
        return redirect()->route($this->routeName . '.index');

    }

    protected function formData(?Model $model = null): array
    {
        return [
            'phone' => $model?->info?->phone,
            'model' => $model,
            'selected' => $model?->getRoleNames(),
            'avatar' => $model?->getFirstMediaUrl('avatar'),
            'logo' => $model?->getFirstMediaUrl('logo'),
        ];
    }
}
