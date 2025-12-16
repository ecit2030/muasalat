<?php

namespace Modules\Vehicle\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Resources\WebJsonResource;
use App\Support\Crud\WithCrud;
use Arr;
use Modules\Vehicle\Datatables\Dashboard\UserVehicleDatatable;
use Modules\Vehicle\Http\Requests\Dashboard\UserVehicleRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Vehicle\Http\Requests\Dashboard\UpdateUserVehicleRequest;
use Modules\Vehicle\Http\Resources\AjaxGetModelsResource;
use Modules\Vehicle\Models\UserVehicle;
use Modules\Vehicle\Models\VehicleBrand;
use Modules\Vehicle\Models\VehicleModel;
use Moltaqa\Wasl\Wasl;

class UserVehicleController extends DashboardController
{
    use WithCrud;

    protected string $routeName = 'modules.vehicle.dashboard.user-vehicle';

    protected string $viewPath = 'Vehicle::dashboard.userVehicle';

    protected string $model = UserVehicle::class;

    protected string $permissions = "user_vehicle";

    protected string $formRequest = UserVehicleRequest::class;

    protected string $datatable = UserVehicleDatatable::class;

    private ?array $data = [];


    protected function storeAction(array $validated)
    {
        $validated["user_id"] = auth()->user()->id;
        $validated['vehicle_letter'] = $validated['vehicle_letter_right'].$validated['vehicle_letter_middle'].$validated['vehicle_letter_left'];
        unset($validated['vehicle_letter_right']);
        unset($validated['vehicle_letter_middle']);
        unset($validated['vehicle_letter_left']);
        $model = UserVehicle::create($validated);

        foreach ($validated["vehicle"] as $vehicle) {
            $model->addMedia($vehicle)->toMediaCollection("vehicle");
        }

        uploadMedia('vehicleForm', $validated["vehicle_form"], $model);
        uploadMedia('vehicleLicense', $validated["vehicle_license"], $model);
        uploadMedia('vehicleEnsurance', $validated["vehicle_ensurance"], $model);
        uploadMedia('vehiclePeriodic', $validated["vehicle_periodic"], $model);
    }

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'isAdmin' => !auth()->user()->hasRole('admin') ? true : false,
            'title' => "",
        ]);
    }
    public function show()
    {
        $model = UserVehicle::find(request("user_vehicle"));
        $vehicle = $model->getMedia('vehicle')->pluck("original_url");
        return view($this->viewPath . ".show", get_defined_vars());
    }

    protected function ajaxGetModels()
    {
        $vehicleBrand = VehicleBrand::find(request("id"));
        $vehicleBrand = $vehicleBrand->models()->select("name", "id", "capacity")->get();
        return AjaxGetModelsResource::collection($vehicleBrand);
    }

    protected function ajaxGetYears()
    {
        $vehicleModel = VehicleModel::find(request("id"));
        $vehicleModel = $vehicleModel->years()->select("year", "id")->get();
        return WebJsonResource::collection($vehicleModel);
    }

    protected function update(UpdateUserVehicleRequest $request, UserVehicle $userVehicle)
    {
        $validated = $request->validated();
        $validated['vehicle_letter'] = $validated['vehicle_letter_right'].$validated['vehicle_letter_middle'].$validated['vehicle_letter_left'];
        unset($validated['vehicle_letter_right']);
        unset($validated['vehicle_letter_middle']);
        unset($validated['vehicle_letter_left']);

        if (isset($validated["vehicle_form"])) {
            uploadMedia('vehicleForm', $validated["vehicle_form"], $userVehicle);
            unset($validated["vehicle_form"]);
        }

        if (isset($validated["vehicle_license"])) {
            uploadMedia('vehicleLicense', $validated["vehicle_license"], $userVehicle);
            unset($validated["vehicle_license"]);
        }

        if (isset($validated["vehicle_ensurance"])) {
            uploadMedia('vehicleEnsurance', $validated["vehicle_ensurance"], $userVehicle);
            unset($validated["vehicle_ensurance"]);
        }

        if (isset($validated["vehicle_periodic"])) {
            uploadMedia('vehiclePeriodic', $validated["vehicle_periodic"], $userVehicle);
            unset($validated["vehicle_periodic"]);
        }

        if (isset($validated["vehicle"])) {
            $userVehicle->clearMediaCollection("vehicle");

            foreach ($validated["vehicle"] as $vehicle) {
                $userVehicle->addMedia($vehicle)->toMediaCollection("vehicle");
            }
            unset($validated["vehicle"]);
        }

        $userVehicle->update($validated);

        return redirect()->route($this->routeName . ".index");
    }

    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);

        // foreach ($model->tracks as $track) {
        //     if ($track->trips()->whereNull("start_at")->whereNull("end_at")->count()){
        //         $check = false;
        //         break ;
        //     };
        // };

        $check = $model->tracks()->count();

        if ($check == 0) {
            $this->code = 200;
            $this->message = t_('Data has been deleted successfully');
            $action = $this->destroyAction($model);
            return $action ?? $this->successfulRequest(asJson: true);
        };

        $this->code = 400;
        $this->message = t_('cant deleted this record') . ' ' . t_("this vehicle belongs to one or many tracks");

        return $action ?? $this->successfulRequest(asJson: true);
    }


    protected function formData(?Model $model = null): array
    {
        $selectedLetterRight = '';
        $selectedLetterMiddle = '';
        $selectedLetterLeft = '';
        if(!is_null($model?->vehicle_letter)){
            $storedLetters = mb_str_split($model?->vehicle_letter) ?? [];
            $selectedLetterRight = $storedLetters[0];
            $selectedLetterMiddle = $storedLetters[1];
            $selectedLetterLeft = $storedLetters[2];
        }
        $selectedVehicleBrand = $model?->year?->model?->brand?->id;
        $selectedVehicleModel = $model?->year?->model?->id;
        $selectedVehicleYear  = $model?->year?->id;

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
        $letters = array_combine($letters,$letters);
        return [
            "letters" => $letters,
            "vehicleNumber" => $model?->vehicle?->vehicle_number,
            "vehicleSequenceNumber" => $model?->vehicle?->sequence_number,

            "licenseEndDate" => $model?->vehicle?->license_end_date,
            "ensuranceEndDate" => $model?->vehicle?->ensurance_end_date,
            "periodicEndDate" => $model?->vehicle?->periodic_end_date,


            "vehicleForm" => $model?->getFirstMediaUrl('vehicleForm'),
            "vehicleLicense" => $model?->getFirstMediaUrl('vehicleLicense'),
            "vehicleEnsurance" => $model?->getFirstMediaUrl('vehicleEnsurance'),
            "vehiclePeriodic" => $model?->getFirstMediaUrl('vehiclePeriodic'),

            'vehicle' => $model?->getMedia("vehicle")->pluck("original_url"),

            'vehicleBrand'   => VehicleBrand::select("id", "name")->whereHas('models',function($query){
                $query->whereHas('years');
            })->get()->pluck("name", "id")->toArray(),
            'vehicleModel' => $vehicleModel ?? [],
            'vehicleYear'  => $vehicleYear ?? [],

            "selectedVehicleYear"  => $selectedVehicleYear,
            "selectedVehicleModel" => $selectedVehicleModel,
            "selectedVehicleBrand" => $selectedVehicleBrand,
            "selectedLetterRight" => $selectedLetterRight,
            "selectedLetterMiddle" => $selectedLetterMiddle,
            "selectedLetterLeft" => $selectedLetterLeft,
        ];
    }
}
