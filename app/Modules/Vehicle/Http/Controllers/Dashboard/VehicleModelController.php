<?php

namespace Modules\Vehicle\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Resources\WebJsonResource;
use App\Support\Crud\WithCrud;

use Modules\Vehicle\Datatables\Dashboard\VehicleModelDatatable;
use Modules\Vehicle\Http\Requests\Dashboard\VehicleModelRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Vehicle\Models\VehicleBrand;
use Modules\Vehicle\Models\VehicleModel;

class VehicleModelController extends DashboardController
{
    use WithCrud ;

    protected string $routeName = 'modules.vehicle.dashboard.vehicle-model';

    protected string $viewPath = 'Vehicle::dashboard.vehicleModel';

    protected string $model = VehicleModel::class;

    protected string $permissions = "vehicle";

    protected string $formRequest = VehicleModelRequest::class;

    protected string $datatable = VehicleModelDatatable::class;

    private ?array $data = [];


    protected function storeAction(array $validated)
    {
        $this->model::create($validated);

        return redirect(route($this->routeName . ".index",  "vehicle_brand_id=" . request("vehicle_brand_id")));
    }

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
            "mapping"=> "\\ " . VehicleBrand::find(request("vehicle_brand_id"))?->getTranslation("name" , get_current_lang())
        ]);
    }

    public function show()
    {
        return redirect()->route("modules.vehicle.dashboard.vehicle-year.index" , ["vehicle_model_id" => request("vehicle_model")]) ;
    }

    protected function updateAction(array $validated, Model $model)
    {
        $model->update($validated);

        return redirect(route($this->routeName . ".index",  "vehicle_brand_id=" . $model->vehicle_brand_id));
    }

    protected function ajaxGetYears()
    {
        $vehicleModel = VehicleModel::find(request("id"));
        $vehicleModel = $vehicleModel->years()->select("year" , "id")->get() ;
        return WebJsonResource::collection($vehicleModel);

    }

    protected function formData(?Model $model = null ): array
    {
        return [
            "model" => $model,
        ];
    }
}
