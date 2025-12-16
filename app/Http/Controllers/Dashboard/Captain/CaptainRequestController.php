<?php

namespace App\Http\Controllers\Dashboard\Captain;

use App\Datatables\Dashboard\Captain\CaptainRequestDatatable;
use App\Enums\General\RolesEnum;
use App\Events\SendSmsMessageEvent;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Captain\UpdateCaptainRequestRequest;
use App\Models\JoinRequest;
use App\Models\User;
use App\Notifications\FcmNotification;
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
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Modules\Code\Entities\Code;
use Modules\Code\Services\EmailService;
use Modules\Vehicle\Models\UserVehicle;
use Modules\Vehicle\Models\VehicleBrand;
use Modules\Vehicle\Models\VehicleModel;
use Modules\Vehicle\Models\VehicleYear;
use Str;

class CaptainRequestController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.captain.captainRequest';

    protected string $datatable = CaptainRequestDatatable::class;

    protected string $permissions = 'captain_request';

    protected string $model = User::class;

    public function show($id)
    {
        $user = User::findOrFail($id);
        $vehicle = $user?->vehicle?->getMedia('vehicle')->pluck("original_url");

        return view($this->routeName . '.show', get_defined_vars());
    }

    protected function update(UpdateCaptainRequestRequest $request, $id)
    {
        $model = $this->model::findOrFail($id);

        $avatar = Arr::pull($request, 'avatar');
        $avatar && uploadMedia('avatar', $avatar, $model);
        $vehicle = Arr::pull($request, 'vehicle');
        $vehicle && uploadMedia('vehicle', $vehicle, $model);

        $model->update(request()->all());

        return redirect()->route($this->routeName . ".index");
    }

    protected function approve($id)
    {
        $data = $this->model::findOrFail($id);
        // $model = $data->toArray();

        // $validator = Validator::make($model, [
        //     "email" => "unique:users,email",
        //     "phone" => "unique:users,phone",
        //     'vehicle_number' => 'required|numeric|unique:user_vehicles,vehicle_number',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator);
        // }

        // $model["password"] = Hash::make($code_number = Str::random(8));

        // $model = User::create($model);

        // $model->vehicle()->create([
        //     "vehicle_year_id" => $data->vehicle_year_id,
        //     "vehicle_number"  => $data->vehicle_number,
        // ]);

        // $roles[] = RolesEnum::captain()->value;
        // $model->syncRoles($roles);

        // $email = new EmailService();
        // $email->sendRandomPassword($model->email, User::class, "hello", "dude", $code_number);


        // $mediaItem = $data->getMedia("avatar")->first();
        // $mediaItem && $mediaItem->move($model, 'avatar', 'public');

        // $mediaItem = $data->getMedia("vehicle")->first();
        // $mediaItem && $mediaItem->move($model->vehicle, 'vehicle', 'public');

        // $data->delete();


        $data->update([
            "is_active" => true,
            "status" => 'active'
        ]);
//        $email = new EmailService();
//        $email->activation(t_('messages.account_activated_title'), t_('messages.account_activated'), $data->email);

        $message = t_('messages.account_activated');
        $number = preg_replace("/^05/", "9665", $data->phone);
        try {
            Http::post('https://api-sms.4jawaly.com/api/v1/sendsms', [
                "username" => "4sWAbjaYjc27ZSwdhfDxzK4Gg0yO4pWg61ac9JwI",
                "password" => "Q7AHqMmlskxrRQ4uXWugQ0AUEdGSyMivAIfo1jt1W5aql8UTxJ88CDrag5o7HPzhxDDr138o5WEdrheEEN6Mj4PXL30Ty3tOYM0B",
                "message" => $message,
                "sender" => "muasalat",
                "numbers" => $number
            ]);
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
        $data->notify(new FcmNotification($data->sendableTokens, t_('messages.account_activated_title'), t_('messages.account_activated')));
        return redirect()->route($this->routeName . ".index");
    }


    protected function revoke(Request $request, $id)
    {
        $data = $this->model::findOrFail($id);
        $data->delete();
        $message = __('messages.your join request is rejected and the reason is :reason', ['reason' => $request->reason]);
        $number = preg_replace("/^05/", "9665", $data->phone);

        try {
            Http::post('https://api-sms.4jawaly.com/api/v1/sendsms', [
                "username" => "4sWAbjaYjc27ZSwdhfDxzK4Gg0yO4pWg61ac9JwI",
                "password" => "Q7AHqMmlskxrRQ4uXWugQ0AUEdGSyMivAIfo1jt1W5aql8UTxJ88CDrag5o7HPzhxDDr138o5WEdrheEEN6Mj4PXL30Ty3tOYM0B",
                "message" => $message,
                "sender" => "muasalat",
                "numbers" => $number
            ]);
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
        return redirect()->route($this->routeName . ".index");
    }

    protected function check($id)
    {
        $data = $this->model::findOrFail($id);
        return redirect()->route($this->routeName . ".index");
    }

    protected function formData(?Model $model = null): array
    {
        $vehicleYear = $model?->vehicleYear;
        // dd($model?->vehicle_year_id);
        // dd($vehicleYear);

        $selectedVehicleBrand = $vehicleYear?->model?->brand?->id;
        $selectedVehicleModel = $vehicleYear?->model?->id;
        $selectedVehicleYear = $vehicleYear?->id;

        if ($selectedVehicleBrand) {
            $vehicleModel = VehicleBrand::findOrFail($selectedVehicleBrand)->models()->select("name", "id")->get()->pluck("name", "id")->toArray();
        }

        if ($selectedVehicleModel) {
            $vehicleYear = VehicleModel::findOrFail($selectedVehicleModel)->years()->select("year", "id")->get()->pluck("year", "id")->toArray();
        }

        return ([
            "vehicleNumber" => $model?->vehicle?->vehicle_number,
            'phone' => $model?->info?->phone,
            'model' => $model,
            'selected' => "",
            'avatar' => $model?->getFirstMediaUrl('avatar'),

            'ussid' => $model?->getFirstMediaUrl('ussid'),
            'ussidNumber' => $model?->ussid_number,
            'driverLicense' => $model?->getFirstMediaUrl('driverLicense'),
            'driverLicenseNumber' => $model?->driver_license_number,
            'driverLicenseEndDate' => $model?->driver_license_end_date,

            'vehicleLetter' => $model?->vehicle?->vehicle_letter,
            'vehicleColor' => $model?->vehicle?->color,

            'vehicleLicense' => $model?->vehicle->getFirstMediaUrl('vehicleLicense'),
            'licenseEndDate' => $model?->vehicle->license_end_date,

            'vehicleEnsurance' => $model?->vehicle->getFirstMediaUrl('vehicleEnsurance'),
            'ensuranceEndDate' => $model?->vehicle->ensurance_end_date,

            'vehiclePeriodic' => $model?->vehicle->getFirstMediaUrl('vehiclePeriodic'),
            'periodicEndDate' => $model?->vehicle->periodic_end_date,

            'vehicle' => $model?->vehicle->getMedia('vehicle')->pluck("original_url"),
            'vehicleForm' => $model?->vehicle->getFirstMediaUrl('vehicleForm'),

            'vehicleBrand' => VehicleBrand::select("id", "name")->get()->pluck("name", "id")->toArray(),
            'vehicleModel' => $vehicleModel ?? [],
            'vehicleYear' => $vehicleYear ?? [],

            "selectedVehicleYear" => $selectedVehicleYear,
            "selectedVehicleModel" => $selectedVehicleModel,
            "selectedVehicleBrand" => $selectedVehicleBrand,
        ]);
    }
}
