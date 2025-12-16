<?php

namespace App\Http\Controllers\Dashboard\Captain;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Datatables\Dashboard\Captain\CaptainDatatable;
use App\Enums\General\RolesEnum;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Captain\CaptainRequest;
use App\Http\Requests\Dashboard\Captain\StoreCaptainRequest;
use App\Http\Requests\Dashboard\Captain\UpdateCaptainRequest;
use App\Models\Trip;
use App\Models\User;
use App\Notifications\FcmNotification;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Modules\Code\Services\EmailService;
use Modules\Vehicle\Models\UserVehicle;
use Modules\Vehicle\Models\VehicleBrand;
use Modules\Vehicle\Models\VehicleModel;
use Moltaqa\Wasl\Wasl;

class CaptainController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.captain.captain';

    protected string $datatable = CaptainDatatable::class;

    protected string $permissions = 'captain';

    protected string $model = User::class;

    public function show($id)
    {
        $user = User::findOrFail($id);
        $vehicle = $user?->vehicle?->getMedia('vehicle')->pluck("original_url");

        return view($this->routeName . '.show', get_defined_vars());
    }


    protected function store(StoreCaptainRequest $request)
    {
        $req = $request->validated();
        $req['vehicle_letter'] = $req['vehicle_letter_right'] . $req['vehicle_letter_middle'] . $req['vehicle_letter_left'];
        unset($req['vehicle_letter_right']);
        unset($req['vehicle_letter_middle']);
        unset($req['vehicle_letter_left']);
        $roles[] = RolesEnum::captain()->value;
        $model = $this->queryBuilder()->create($req);

        $model->status = "active";
        $model->save();

        $model->vehicle()->create($req);

        if ($request->has("avatar")) {
            uploadMedia('avatar', $req["avatar"], $model);
        }
        uploadMedia('ussid', $req["ussid"], $model);
        uploadMedia('driverLicense', $req["driver_license"], $model);

        uploadMedia('vehicleLicense', $req["vehicle_license"], $model->vehicle);
        uploadMedia('vehicleEnsurance', $req["vehicle_ensurance"], $model->vehicle);
        uploadMedia('vehiclePeriodic', $req["vehicle_periodic"], $model->vehicle);
        uploadMedia('vehicleForm', $req["vehicle_form"], $model->vehicle);


        foreach ($request["vehicle"] as $vehicle) {
            $model->vehicle->addMedia($vehicle)->toMediaCollection("vehicle");
        }
        $model->syncRoles($roles);

        $email = new EmailService();
        $email->sendRandomPassword($model["email"], t_("welcome_in_musasalat"), t_("You_password_is"), $request->password);


        return redirect()->route($this->routeName . ".index");
    }

    protected function update(UpdateCaptainRequest $request, $id)
    {
        $data = $request->validated();
        $data['vehicle_letter'] = $data['vehicle_letter_right'] . $data['vehicle_letter_middle'] . $data['vehicle_letter_left'];
        unset($data['vehicle_letter_right']);
        unset($data['vehicle_letter_middle']);
        unset($data['vehicle_letter_left']);
        $model = User::query()->with('captainTracks')->findOrFail($id);
        if ($model->is_active && $request->is_active == 0 && Trip::whereIn('track_id', $model->captainTracks->pluck('id')->toArray())->whereNull('end_at')->exists()) {
            return $this->errorRequest(message: 'Has schaduled or ongoing trips');
        }
        $model->load('deviceTokens');
        if (isset($data["ussid"])) {
            uploadMedia('ussid', $data["ussid"], $model);
            unset($data["ussid"]);
        }

        if (isset($data["avatar"])) {
            uploadMedia('avatar', $data["avatar"], $model);
            unset($data["avatar"]);
        }

        if (isset($data["driver_license"])) {
            uploadMedia('driverLicense', $data["driver_license"], $model);
            unset($data["driver_license"]);
        }

        if (isset($data["vehicle_form"])) {
            uploadMedia('vehicleForm', $data["vehicle_form"], $model->vehicle);
            unset($data["vehicle_form"]);
        }

        if (isset($data["vehicle_license"])) {
            uploadMedia('vehicleLicense', $data["vehicle_license"], $model->vehicle);
            unset($data["vehicle_license"]);
        }

        if (isset($data["vehicle_ensurance"])) {
            uploadMedia('vehicleEnsurance', $data["vehicle_ensurance"], $model->vehicle);
            unset($data["vehicle_ensurance"]);
        }

        if (isset($data["vehicle_periodic"])) {
            uploadMedia('vehiclePeriodic', $data["vehicle_periodic"], $model->vehicle);
            unset($data["vehicle_periodic"]);
        }

        if (isset($data["vehicle"])) {
            $model->vehicle->clearMediaCollection("vehicle");

            foreach ($data["vehicle"] as $vehicle) {
                $model->vehicle->addMedia($vehicle)->toMediaCollection("vehicle");
            }
            unset($data["vehicle"]);
        }

        $roles[] = RolesEnum::captain()->value;

        $isUpdated = $model->update($data);
        if ($isUpdated) {
            UserVehicle::findOrFail($model->vehicle->id)->update($data);
            $model->syncRoles($roles);
            $model->notify(new FcmNotification($model->sendableTokens, __("Profile Updated"), __('Your Profile updated by adminstration'), FCMTopic::ADMIN_UPDATE_DRIVER_PROFILE, FCMAction::DRIVER_OPEN_EDIT_PROFILE));
        }
        return redirect()->route($this->routeName . ".index");
    }

    public function activation(Request $request)
    {
        $model = $this->model::query()->with('captainTracks')->findOrFail($request->model_id);
        if ($model->is_active && Trip::whereIn('track_id', $model->captainTracks->pluck('id')->toArray())->whereNull('end_at')->exists()) {
            return $this->errorRequest(message: 'Has schaduled or ongoing trips');
        }
        $model->is_active = !$model->is_active;
        if ($request->reason) {
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
        $selectedLetterRight = '';
        $selectedLetterMiddle = '';
        $selectedLetterLeft = '';
        if (!is_null($model?->vehicle?->vehicle_letter)) {
            $storedLetters = mb_str_split($model?->vehicle?->vehicle_letter) ?? [];
            $selectedLetterRight = $storedLetters[0] ?? '';
            $selectedLetterMiddle = $storedLetters[1] ?? '';
            $selectedLetterLeft = $storedLetters[2] ?? '';
        }
        $vehicleYear = $model?->vehicleYear;
        $selectedVehicleBrand = $vehicleYear?->model?->brand?->id;
        $selectedVehicleModel = $vehicleYear?->model?->id;
        $selectedVehicleYear = $vehicleYear?->id;

        if ($selectedVehicleBrand) {
            $vehicleModel = [];

            VehicleBrand::find($selectedVehicleBrand)->models()->select("name", "id", "capacity")
                ->get()->map(function ($q) use (&$vehicleModel) {
                    return $vehicleModel[$q->id] = $q->nameCapacity;
                });
        }

        if ($selectedVehicleModel) {
            $vehicleYear = VehicleModel::find($selectedVehicleModel)->years()->select("year", "id")->get()->pluck("year", "id")->toArray();
        }
        $letters = array_values(Wasl::getInstance()->getVehiclePlateLetters());
        $letters = array_combine($letters, $letters);
        return ([
            "letters" => $letters,
            "model" => $model,
            "vehicleSequenceNumber" => $model?->vehicle?->sequence_number,
            'phone' => $model?->info?->phone,
            'selected' => $model?->getRoleNames(),
            'avatar' => $model?->getFirstMediaUrl('avatar'),

            'ussid' => $model?->getFirstMediaUrl('ussid'),
            'ussidNumber' => $model?->ussid_number,
            'driverLicense' => $model?->getFirstMediaUrl('driverLicense'),
            'driverLicenseNumber' => $model?->driver_license_number,
            'driverLicenseEndDate' => $model?->driver_license_end_date,

            'vehicleNumber' => $model?->vehicle->vehicle_number,
            'vehicleLetter' => $model?->vehicle->vehicle_letter,
            'vehicleColor' => $model?->vehicle->color,

            'vehicleLicense' => $model?->vehicle->getFirstMediaUrl('vehicleLicense'),
            'licenseEndDate' => $model?->vehicle->license_end_date,

            'vehicleEnsurance' => $model?->vehicle->getFirstMediaUrl('vehicleEnsurance'),
            'ensuranceEndDate' => $model?->vehicle->ensurance_end_date,

            'vehiclePeriodic' => $model?->vehicle->getFirstMediaUrl('vehiclePeriodic'),
            'periodicEndDate' => $model?->vehicle->periodic_end_date,

            'vehicle' => $model?->vehicle->getMedia('vehicle')->pluck("original_url"),
            'vehicleForm' => $model?->vehicle->getFirstMediaUrl('vehicleForm'),

            'vehicleBrand' => VehicleBrand::select("id", "name")->whereHas('models', function ($query) {
                $query->whereHas('years');
            })->get()->pluck("name", "id")->toArray(),
            'vehicleModel' => $vehicleModel ?? [],
            'vehicleYear' => $vehicleYear ?? [],

            "selectedVehicleYear" => $selectedVehicleYear,
            "selectedVehicleModel" => $selectedVehicleModel,
            "selectedVehicleBrand" => $selectedVehicleBrand,
            "selectedLetterRight" => $selectedLetterRight,
            "selectedLetterMiddle" => $selectedLetterMiddle,
            "selectedLetterLeft" => $selectedLetterLeft,
        ]);
    }

    public function destroy($id)
    {
        $model = $this->model::query()->with('captainTracks')->findOrFail($id);

        if (Trip::query()->whereIn('track_id', $model->captainTracks->pluck('id')->toArray())->doesntExist()) {
            $model->driverTracks()->delete();
            $model->deviceTokens()->delete();
            $this->code = 200;
            $this->message = t_('Data has been deleted successfully');
            $action = $this->destroyAction($model);
            return $action ?? $this->successfulRequest(asJson: true);
        };

        return $action ?? $this->errorRequest(message: 'Has schaduled or ongoing trips');
    }
}
