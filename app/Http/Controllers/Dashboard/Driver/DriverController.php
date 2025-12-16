<?php

namespace App\Http\Controllers\Dashboard\Driver;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Datatables\Dashboard\Driver\DriverDatatable;
use App\Enums\General\RolesEnum;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Driver\StoreDriverRequest;
use App\Http\Requests\Dashboard\Driver\UpdateDriverRequest;
use App\Http\Resources\WebJsonResource;
use App\Models\Trip;
use App\Models\User;
use App\Notifications\FcmNotification;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Illuminate\Http\Request;
use Arr;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Modules\Code\Services\EmailService;
use Modules\Vehicle\Http\Resources\AjaxGetModelsResource;
use Modules\Vehicle\Models\UserVehicle;
use Modules\Vehicle\Models\VehicleBrand;
use Modules\Vehicle\Models\VehicleModel;

class DriverController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.driver.driver';
    protected string $viewPath = 'dashboard.driver.driver';

    protected string $datatable = DriverDatatable::class;

    protected string $permissions = 'driver';

    protected string $model = User::class;

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view($this->routeName . '.show', compact('user'));
    }

    public function index()
    {
        $cars = collect();
        $organization = auth()->user()->hasRole("organization");
        if($organization){
            $cars = auth()->user()->vehicles()->withoutGlobalScopes()->whereNull('driver_id')->get();
        }
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'isAdmin' => !auth()->user()->hasRole('admin') ? true : false,
            'cars' => $cars
        ]);
    }


    protected function store(StoreDriverRequest $request)
    {
        $roles[] = RolesEnum::captain()->value;

        $data = $request->all();
        $data["organization_id"] = auth()->id();

        $model = $this->queryBuilder()->create($data);

        $email = new EmailService();
        $email->sendRandomPassword($data["email"], __("Welcome In Muasalat"), __("Your Login Data Is"), $data["password"],$data['phone']);

        uploadMedia('avatar', $request["avatar"], $model);
        uploadMedia('ussid', $request["ussid"], $model);
        uploadMedia('driverLicense', $request["driver_license"], $model);

        $model->syncRoles($roles);

        return redirect()->route($this->routeName . ".index");
    }

    protected function update(UpdateDriverRequest $request, $id)
    {
        $model = User::query()->with('driverTracks')->findOrFail($id);
        if ($model->is_active && $request->is_active == 0 && Trip::whereIn('track_id', $model->driverTracks->pluck('id')->toArray())->whereNull('end_at')->exists()) {
            return $this->errorRequest(message: 'Has schaduled or ongoing trips');
        }
        $model->load('deviceTokens');
        if (isset($request["ussid"])) {
            uploadMedia('ussid', $request["ussid"], $model);
            unset($request["ussid"]);
        }

        if (isset($request["avatar"])) {
            uploadMedia('avatar', $request["avatar"], $model);
            unset($request["avatar"]);
        }

        if (isset($request["password"]) && $request["password"] != null) {
            $email = new EmailService();
            $email->sendRandomPassword($model->email, t_("welcome_in_musasalat"), t_("your_password_has_changed_to_be"), $request["password"]);
            $request["password"] = Hash::make($request["password"]);
        }

        if (isset($request["driver_license"])) {
            uploadMedia('driverLicense', $request["driver_license"], $model);
            unset($request["driver_license"]);
        }

        $roles[] = RolesEnum::captain()->value;

        $isUpdated = $model->update($request->validated());
        if ($isUpdated) {
            $model->syncRoles($roles);
            $model->notify(new FcmNotification($model->sendableTokens, __("Profile Updated"), __('Your Profile updated by adminstration'), FCMTopic::ADMIN_UPDATE_DRIVER_PROFILE, FCMAction::DRIVER_OPEN_EDIT_PROFILE));
        }

        return redirect()->route($this->routeName . ".index");
    }


    public function destroy($id)
    {
        $model = $this->model::query()->with('driverTracks')->findOrFail($id);

        if (Trip::query()->whereIn('track_id', $model->driverTracks->pluck('id')->toArray())->doesntExist()) {
            $model->driverTracks()->delete();
            $model->deviceTokens()->delete();
            $this->code = 200;
            $this->message = t_('Data has been deleted successfully');
            $action = $this->destroyAction($model);
            return $action ?? $this->successfulRequest(asJson: true);
        };

        $this->code = 400;
        $this->message = t_('cant deleted this record') . " " . t_("this driver belongs to one or many tracks");

        return $action ?? $this->successfulRequest(asJson: true);
    }

    public function activation(Request $request)
    {
        $model = $this->model::query()->with('driverTracks')->findOrFail($request->model_id);
        if ($model->is_active && Trip::whereIn('track_id', $model->driverTracks->pluck('id')->toArray())->whereNull('end_at')->exists()) {
            return $this->errorRequest(message: 'Has schaduled or ongoing trips');
        }
        $model->is_active = !$model->is_active;
        if ($request->filled('reason')) {
            $model->reason = $request->reason;
            $message = t_("your account has been deactivated");
        } else {
            $message = t_("your account has been activated");
            $model->reason = "";
        }
        $model->save();
        if (!$model->is_active)
            $model->tokens()->delete();

        $email = new EmailService();
        $email->activation(t_("dear, user"), $message, $model->email, $request?->reason ?? '');
        return redirect()->route($this->routeName . '.index');
    }

    protected function formData(?Model $model = null): array
    {
        return [
            'phone' => $model?->info?->phone,
            'selected' => $model?->getRoleNames(),
            'avatar' => $model?->getFirstMediaUrl('avatar'),
            'ussid' => $model?->getFirstMediaUrl('ussid'),
            'ussidNumber' => $model?->ussid_number,
            'driverLicense' => $model?->getFirstMediaUrl('driverLicense'),
            'driverLicenseNumber' => $model?->driver_license_number,
            'driverLicenseEndDate' => $model?->driver_license_end_date,
        
        ];
    }

    protected function ajaxGetModels()
    {
        $vehicleBrand = VehicleBrand::findOrFail(request("id"));
        $vehicleBrand = $vehicleBrand->models()->select("name", "id", "capacity")->get();
        return AjaxGetModelsResource::collection($vehicleBrand);
    }

    protected function ajaxGetYears()
    {
        $vehicleModel = VehicleModel::findOrFail(request("id"));
        $vehicleModel = $vehicleModel->years()->select("year", "id")->get();
        return WebJsonResource::collection($vehicleModel);
    }

    public function assignVeichle(Request $request){
        $request->validate(['veichle' => 'required',['veichle.required' => __("veichle is required")]]);

        $car = UserVehicle::find($request->veichle);
        $car->update(['driver_id' => $request->model_id]);

        return redirect()->back()->with(['message' => __('veichle assigned to driver')]);
    }
}
