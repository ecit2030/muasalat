<?php

namespace Modules\Vehicle\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Crud\WithCrud;

use Modules\Vehicle\Datatables\Dashboard\VehicleRequestDatatable;
use Modules\Vehicle\Http\Requests\Dashboard\VehicleRequestRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Vehicle\Models\VehicleRequest;

class VehicleRequestController extends DashboardController
{
    use WithCrud;

    protected string $routeName = 'modules.vehicle.dashboard.vehicle-request';

    protected string $viewPath = 'Vehicle::dashboard.vehicleRequest';

    protected string $model = VehicleRequest::class;

    protected string $permissions = "vehicle_request";

    protected string $formRequest = VehicleRequestRequest::class;

    protected string $datatable = VehicleRequestDatatable::class;

    private ?array $data = [];


    protected function storeAction(array $validated)
    {
        VehicleRequest::create([
            "user_id" => auth()->user()->id,
            "content" => $validated["content"],
        ]);
        if (auth()->user()->hasRole("admin")) {
            return $this->index();
        } else {
            return redirect(route("dashboard.home"));
        }
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
        return view($this->viewPath . ".show", ["model" => VehicleRequest::find(request("vehicle_request"))]);
    }

    protected function updateAction(array $validated, Model $model)
    {
        if($model->update($validated))
            return redirect(route($this->routeName . ".index"));
        return redirect()->back()->withInput();
    }

    protected function formData(?Model $model = null ): array
    {
        $statuses = array();
        if(!is_null($model)){
            $statuses = ['approved','rejected'];
            $statusesTrans = [__('Approved'),__('Rejected')];
            $statuses = array_combine($statuses,$statusesTrans);
        }
        return [
            "model" => $model,
            "statuses" => $statuses,
        ];
    }
}
