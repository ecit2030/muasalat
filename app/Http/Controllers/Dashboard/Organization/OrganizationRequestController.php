<?php

namespace App\Http\Controllers\Dashboard\Organization;

use App\Datatables\Dashboard\Organization\OrganizationRequestDatatable;
use App\Enums\General\RolesEnum;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Organization\UpdateOrganizationRequestRequest;
use App\Mail\SendPassword;
use App\Models\JoinRequest;
use App\Models\User;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Arr;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Mail;
use Modules\Code\Services\EmailService;
use Str;

class OrganizationRequestController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.organization.organizationRequest';

    protected string $datatable = OrganizationRequestDatatable::class;

    protected string $permissions = 'organization_request';

    protected string $model = JoinRequest::class;

    public function show($id)
    {
        $user = JoinRequest::findOrFail($id);
        return view($this->routeName . '.show', compact('user'));
    }

    protected function update(UpdateOrganizationRequestRequest $request, $id)
    {
        $model = JoinRequest::findOrFail($id);
        $data = $request->all();

        $logo = Arr::pull($request, 'logo');
        $logo && uploadMedia('logo', $logo, $model);
        $model->update($data);

        return redirect()->route($this->routeName . ".index");
    }


    protected function approve($id)
    {
        $data = $this->model::findOrFail($id);
        $model = $data->toArray();

        $validator = Validator::make($model, [
            "email" => "unique:users,email",
            "phone" => "unique:users,phone",
            "organization_name" => "unique:users,organization_name",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $model["password"] = Hash::make($password = Str::random(8));

        $email = new EmailService();
        $email->sendRandomPassword($model["email"], t_("welcome_in_musasalat") , t_("You_password_is") , $password);

        DB::beginTransaction();

        $organization = User::create($model);
        $organization->assignRole("organization");

        $avatarMediaItems = $data->getMedia('avatar');
        foreach ($avatarMediaItems as $mediaItem) {
            $organization->addMedia($mediaItem->getPath())
                ->usingFileName($mediaItem->file_name)
                ->toMediaCollection('avatar');

            $mediaItem->delete();
        }


        $logoMediaItems = $data->getMedia('logo');
        foreach ($logoMediaItems as $mediaItem) {
            $organization->addMedia($mediaItem->getPath())
                ->usingFileName($mediaItem->file_name)
                ->toMediaCollection('logo');

            $mediaItem->delete();
        }

        // moveTempMedia("logo", $organization, "logo");
        // moveTempMedia("avatar", $organization, "avatar");

        $data->delete();
        
        DB::commit();
        return redirect()->route($this->routeName . ".index");

    }

    protected function revoke(Request $request, $id)
    {
        $request->validate([
            "reject_reason" => "required",
        ]);
        $data = $this->model::findOrFail($id);

        $email = new EmailService();
        $email->sendRejectJoin($data->email,__('Join Rejected'), __("your join request as organization is rejected and reason is :reason",['reason' => $request->reject_reason]));

        $data->delete();
        return redirect()->route($this->routeName . ".index");
    }

    protected function formData(?Model $model = null): array
    {
        return [
            'phone' => $model?->info?->phone,
            'model' => $model,
            'selected' => "",
            'avatar' => $model?->getFirstMediaUrl('avatar'),
            'logo' => $model?->getFirstMediaUrl('logo'),
        ];
    }
}
