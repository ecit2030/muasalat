<?php

namespace Modules\Vehicle\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Resources\WebJsonResource;
use App\Support\Crud\WithCrud;

use Modules\Vehicle\Datatables\Dashboard\VehicleBrandDatatable;
use Modules\Vehicle\Http\Requests\Dashboard\VehicleBrandRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Vehicle\Http\Resources\AjaxGetModelsResource;
use Modules\Vehicle\Models\VehicleBrand;
use Modules\Vehicle\Models\VehicleModel;

class VehicleBrandController extends DashboardController
{
    use WithCrud ;

    protected string $routeName = 'modules.vehicle.dashboard.vehicle-brand';

    protected string $viewPath = 'Vehicle::dashboard.vehicleBrand';

    protected string $model = VehicleBrand::class;

    protected string $permissions = "vehicle";

    protected string $formRequest = VehicleBrandRequest::class;

    protected string $datatable = VehicleBrandDatatable::class;

    private ?array $data = [];


    protected function storeAction(array $validated)
    {
        $this->model::create($validated);
    }

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
        ]);
    }
    public function show()
    {
        return redirect()->route("modules.vehicle.dashboard.vehicle-model.index" , ["vehicle_brand_id" => request("vehicle_brand")]) ;
    }

    protected function updateAction(array $validated, Model $model)
    {
        $model->update($validated);
    }

    protected function ajaxGetModels()
    {
        $vehicleBrand = VehicleBrand::findOrFail(request("id"));
        $vehicleBrand = $vehicleBrand->models()->select("name" , "id" , "capacity")->get() ;
        return AjaxGetModelsResource::collection($vehicleBrand);
    }

    protected function formData(?Model $model = null ): array
    {
        return [
            "model" => $model,
        ];
    }
}
