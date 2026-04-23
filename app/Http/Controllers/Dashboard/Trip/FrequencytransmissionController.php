<?php

namespace App\Http\Controllers\Dashboard\Trip;

use App\Datatables\Dashboard\Trip\FrequencytransmissionDatatable;
use App\Datatables\Dashboard\Trip\FrequencyTransmissionTripsDatatable;
use App\Datatables\Dashboard\Trip\TripByTrackDatatable;
use App\Datatables\Dashboard\Trip\TripDatatable;
use App\Exports\TripExport;
use App\Exports\TripSheetExport;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Trip\GenerateTrackPDFRequest;
use App\Http\Requests\Dashboard\Trip\StoreFrequencyTransmissionRequest;
use App\Models\Track;
use App\Models\Trip;
use App\Models\User;
use App\Models\FrequencyTransmission;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use App\Support\Helper\MhelperClass;
use Carbon\Carbon;
use \PDFMerger;
use Illuminate\Database\Eloquent\Model;
use Modules\Vehicle\Models\UserVehicle;


class FrequencytransmissionController extends DashboardController
{
	use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.trips.frequencytransmissions';
    protected string $viewPath = 'dashboard.trips.frequencytransmissions';

    protected string $datatable = FrequencytransmissionDatatable::class;
  //  protected string $datatabletrack = TripByTrackDatatable::class;

    protected string $permissions = 'trip';

    protected string $model = FrequencyTransmission::class;

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
            'status' => request('status'),
        ]);
    }

    public function trips()
    {
        $datatable = FrequencyTransmissionTripsDatatable::class;

        return $datatable::create($this->viewPath)->render("{$this->viewPath}.trips", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
        ]);
    }

     protected function store(StoreFrequencyTransmissionRequest $request)
     {
     		$data = $request->validated();

		    $data['created_by'] = auth()->id();
		    $data['updated_by'] = auth()->id();

		    $data['repeat'] = $data['repeat'] ?? [];
		    $data['origin'] = $data['origin'] ?? null;
		    $data['destination'] = $data['destination'] ?? null;
		    $data['relay_point'] = $data['relay_point'] ?? null;
		    $data['specificlocation'] = $data['specificlocation'] ?? null;
		    $data['details'] = $data['details'] ?? null;
		    

		    FrequencyTransmission::create($data);

		    return redirect()
		        ->route('dashboard.trips.frequencytransmissions.index')
		        ->with('success', t_('created_successfully'));
     }
	
	public function show($id)
	{
	    $model = FrequencyTransmission::findOrFail($id)
	        ->makeVisible('map_route_data');

	    return view($this->viewPath . '.show', [
	        'model' => $model,

	        'days' => [
	            'monday',
	            'tuesday',
	            'wednesday',
	            'thursday',
	            'friday',
	            'saturday',
	            'sunday',
	        ],

	        'driver' => $model->driver?->name ?? '--',

	        'vehicle' => $model->vehicle
	            ? $model->vehicle->vehicle_number . ' - ' . $model->vehicle->vehicle_letter
	            : '--',

	        'origin' => $model->origin ?? [],
	        'destination' => $model->destination ?? [],
	        'repeat' => $model->repeat ?? [],
	        'map_route_data' => $model->map_route_data ?? [],
	    ]);
	}

	public function destroy($id)
	{
		$model = FrequencyTransmission::findOrFail($id);
		$model->delete();

		return response()->json([
	        'status' => true,
	        'message' => t_('Data has been deleted successfully'),
	    ]);
	}

	public function changeDriver(Request $request, $id)
	{
	    $request->validate([
	        'driver_id' => 'required|exists:users,id'
	    ]);

	    $model = FrequencyTransmission::findOrFail($id);

	    $model->driver_id = $request->driver_id;
	    $model->status_driver = 0;
	    $model->updated_by = auth()->id();
	    $model->save();

	    return back()->with('success', t_('driver_updated_successfully'));
	}

    protected function formData(?Model $model = null): array
	{
	    $userVehicle = [];
	    $drivers = [];

	    if ($model) {

	        // JSON safety
	        $model->map_route_data = json_encode($model->map_route_data);
	        $model->origin = json_encode($model->origin);
	        $model->destination = json_encode($model->destination);
	        $model->repeat = json_encode($model->repeat);

	        // Vehicles
	        UserVehicle::whereIsActive(1)
	            ->select("vehicle_letter", "vehicle_number", "id")
	            ->get()
	            ->map(function ($q) use (&$userVehicle) {
	                $userVehicle[$q->id] = $q->vehicle_number . " - " . $q->vehicle_letter;
	            });

	        // Drivers (based on organization like your system)
	        $drivers = User::role("captain")
	            ->whereIsActive(1)
	            ->whereStatus("active")
	            ->pluck("name", "id")
	            ->toArray();

	    } else {

	        // Vehicles for logged user
	        UserVehicle::whereIsActive(1)
	            ->select("vehicle_letter", "vehicle_number", "id")
	            ->get()
	            ->map(function ($q) use (&$userVehicle) {
	                $userVehicle[$q->id] = $q->vehicle_number . " - " . $q->vehicle_letter;
	            });

	        // Drivers for logged organization
	        $drivers = User::role("captain")
	            ->whereIsActive(1)
	            ->whereStatus("active")
	            ->pluck("name", "id")
	            ->toArray();
	    }

	    return [
	        "model" => $model,

		    "days" => [
		        'monday',
		        'tuesday',
		        'wednesday',
		        'thursday',
		        'friday',
		        'saturday',
		        'sunday',
		    ],

	        // dropdowns
	        "drivers" => $drivers,
	        "userVehicles" => $userVehicle,

	        // selected values
	        "selectedDriver" => $model?->driver_id,
	        "selectedUserVehicle" => $model?->vehicle_id,

	        // main data
	        "data" => $model,

	        // JSON fields (safe for edit forms)
	        "map_route_data" => $model?->map_route_data,
	        "origin" => $model?->origin,
	        "destination" => $model?->destination,
	        "repeat" => $model?->repeat,

	        // extras
	        "date_trans" => $model?->date_trans,
	        "status_driver" => $model?->status_driver,
	        "is_active" => $model?->is_active,
	    ];
	}
}