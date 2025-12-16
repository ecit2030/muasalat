<?php

namespace Modules\Vehicle\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Crud\WithCrud;

use Modules\Vehicle\Datatables\Dashboard\VehicleYearDatatable;
use Modules\Vehicle\Http\Requests\Dashboard\VehicleYearRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Vehicle\Models\VehicleYear;
use Modules\Vehicle\Models\VehicleModel;

class VehicleYearController extends DashboardController
{
    use WithCrud ;

    protected string $routeName = 'modules.vehicle.dashboard.vehicle-year';

    protected string $viewPath = 'Vehicle::dashboard.vehicleYear';

    protected string $model = VehicleYear::class;

    protected string $permissions = "vehicle";

    protected string $formRequest = VehicleYearRequest::class;

    protected string $datatable = VehicleYearDatatable::class;

    private ?array $data = [];


    protected function storeAction(array $validated)
    {
        $this->model::create($validated);
        return redirect(route($this->routeName . ".index",  "vehicle_model_id=" . request("vehicle_model_id")));

    }


    public function index()
    {
        $model = VehicleModel::find(request("vehicle_model_id")) ;
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
            "mapping"=> "\\ " . $model?->brand?->getTranslation("name" , get_current_lang()) . " \\ " . $model?->getTranslation("name" , get_current_lang())

        ]);
    }

    protected function updateAction(array $validated, Model $model)
    {
        $model->update($validated);

        return redirect(route($this->routeName . ".index",  "vehicle_year_id=" . $model->vehicle_year_id));
    }


    protected function formData(?Model $model = null ): array
    {
        return [
            "model" => $model,
        ];
    }
}
