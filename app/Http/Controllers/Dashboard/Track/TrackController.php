<?php

namespace App\Http\Controllers\Dashboard\Track;

use App\Datatables\Dashboard\Track\TrackDatatable;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Track\StoreTrackRequest;
use App\Http\Requests\Dashboard\Track\UpdateTrackRequest;
use App\Models\Track;
use App\Models\User;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use Modules\Vehicle\Models\UserVehicle;

class TrackController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.track.track';
    protected string $viewPath = 'dashboard.track.track';

    protected string $datatable = TrackDatatable::class;

    protected string $permissions = 'track';

    protected string $model = Track::class;

    public function show($id)
    {
        $model = $this->model::findOrFail($id)->makeVisible("map_route_data");
        $days = \Carbon\Carbon::getDays();
        $driver = $model?->driver?->name;
        $vehicle = $model?->vehicle?->vehicle_number . " - " . $model?->vehicle?->vehicle_letter;
        $data = $model;
        $waypoints = $model?->waypoints?->pluck("waypoint");
        return view($this->routeName . '.show', get_defined_vars());
    }

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'isAdmin' => !auth()->user()->hasRole('admin') ? true : false,
            'errors' => [],
        ]);
    }

    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);

        $check = $model->trips()->count() > 0 ;

        if (!$check) {
            $this->code = 200;
            $this->message = t_('Data has been deleted successfully');
            $action = $this->destroyAction($model);
            return $action ?? $this->successfulRequest(asJson: true);
        };

        $this->code = 400;
        $this->message = t_('cant deleted this record') . " " . t_("users has purchased this track");

        return $action ?? $this->successfulRequest(asJson: true);
    }

    protected function store(StoreTrackRequest $request)
    {
        $req = $request->all();
        $req["waypoints"] = [];
        if (isset($req["checkPoint_location"])) {

            foreach ($req["checkPoint_location"] as $key => $value) {
                array_push($req["waypoints"], [
                    "location" => (string) $value,
                    "lat" => (string) $req["checkPoint_latitude"][$key],
                    "lng" => (string) $req["checkPoint_longitude"][$key],
                    "duration" => (string) gmdate("H:i", $req["checkPoint_duration"][$key]),
                    "distance" => (string) floor($req["checkPoint_distance"][$key] / 1000),
                ]);
            }
        }

        $req["origin"] = [
            "location" => (string) $req["start_location"],
            "lat" => (string) $req["start_latitude"],
            "lng" => (string) $req["start_longitude"],
            "start_time" => (string) $req["start_time"],
            "duration" => (string) "00:00",
            "distance" => (string) "0"
        ];

        $req["destination"] = [
            "location" => (string) $req["end_location"],
            "lat" => (string) $req["end_latitude"],
            "lng" => (string) $req["end_longitude"],
            "duration" => (string) gmdate("H:i", $req["end_duration"]),
            "distance" => (string) floor($req["end_distance"] / 1000)
        ];

        $req["owner_id"] = auth()->id();
        $track = $this->model::create($req);

        foreach ($req["waypoints"] as $value) {
            $track->waypoints()->create([
                "waypoint" => $value
            ]);
        }

        return redirect()->route("dashboard.track.track.index");
    }

    protected function update(UpdateTrackRequest $request, Track $track)
    {
        $req = $request->all();
        $req["waypoints"] = [];

        if (isset($req["checkPoint_location"])) {
            foreach ($req["checkPoint_location"] as $key => $value) {
                array_push($req["waypoints"], [
                    "location" => (string) $value,
                    "lat" => (string) $req["checkPoint_latitude"][$key],
                    "lng" => (string) $req["checkPoint_longitude"][$key],
                    "duration" => (string) gmdate("H:i", $req["checkPoint_duration"][$key]),
                    "distance" => (string) floor($req["checkPoint_distance"][$key] / 1000),
                ]);
            }
        }

        $req["origin"] = [
            "location" => (string) $req["start_location"],
            "lat" => (string) $req["start_latitude"],
            "lng" => (string) $req["start_longitude"],
            "start_time" => (string) $req["start_time"],
            "duration" => (string) "00:00",
            "distance" => (string) "0"
        ];

        $req["destination"] = [
            "location" => (string) $req["end_location"],
            "lat" => (string) $req["end_latitude"],
            "lng" => (string) $req["end_longitude"],
            "duration" => (string) gmdate("H:i", $req["end_duration"]),
            "distance" => (string) floor($req["end_distance"] / 1000)
        ];

        $req["owner_id"] = auth()->id();

        $track->update($req);

        if (isset($req["waypoints"])) {
            $track->waypoints()->delete();
            foreach ($req["waypoints"] as $value) {
                $track->waypoints()->create([
                    "waypoint" => $value
                ]);
            }
        }

        return redirect()->route("dashboard.track.track.index");
    }


    protected function formData(?Model $model = null): array
    {
        $userVehicle = [];
        if ($model) {
            $model->map_route_data = json_encode($model->map_route_data);

            UserVehicle::whereUserId($model->owner_id)->whereIsActive(1)->select("vehicle_letter", "vehicle_number", "id")->get()->map(function ($q) use (&$userVehicle) {
                $userVehicle[$q->id] = $q->vehicle_number . " - " . $q->vehicle_letter;
            });

            $drivers = User::whereOrganizationId($model?->owner_id)->role("driver")->whereIsActive(1)->whereStatus("active")->select("name", "id")->get()->pluck("name", "id")->toArray();

            if($model->owner->hasRole("captain")){
                $drivers = [$model->owner->id => $model->owner->name ];
            }

        } else {

            UserVehicle::whereUserId(auth()->user()?->organization_id ?? auth()->id())->whereIsActive(1)->select("vehicle_letter", "vehicle_number", "id")->get()->map(function ($q) use (&$userVehicle) {
                $userVehicle[$q->id] = $q->vehicle_number . " - " . $q->vehicle_letter;
            });

            $drivers = User::whereOrganizationId(auth()->user()?->organization_id ?? auth()->id())->role("driver")->whereIsActive(1)->whereStatus("active")->select("name", "id")->get()->pluck("name", "id")->toArray();
        }



        return [
            "model" => $model,
            "days" => \Carbon\Carbon::getDays(),
            "drivers" => $drivers ?? [],
            "userVehicles" => $userVehicle ?? [],
            "selectedDriver" => $model?->driver_id ?? $model?->owner_id,
            "selectedUserVehicle" => $model?->user_vihicle_id,
            "data" => $model,
            "waypoints" => $model?->waypoints->pluck("waypoint")

        ];
    }
}
