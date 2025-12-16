<?php

namespace App\Http\Controllers\Dashboard\Trip;

use App\Datatables\Dashboard\Trip\TripByTrackDatatable;
use App\Datatables\Dashboard\Trip\TripDatatable;
use App\Exports\TripExport;
use App\Exports\TripSheetExport;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Trip\GenerateTrackPDFRequest;
use App\Models\Track;
use App\Models\Trip;
use App\Support\Crud\WithDatatable;
use App\Support\Crud\WithDestroy;
use App\Support\Crud\WithForm;
use App\Support\Crud\WithStore;
use App\Support\Crud\WithUpdate;
use App\Support\Helper\MhelperClass;
use Carbon\Carbon;
use \PDFMerger;

class TripController extends DashboardController
{
    use WithDatatable, WithForm, WithStore, WithUpdate, WithDestroy;

    protected string $routeName = 'dashboard.trips.trips';
    protected string $viewPath = 'dashboard.trips.trips';

    protected string $datatable = TripDatatable::class;
    protected string $datatabletrack = TripByTrackDatatable::class;

    protected string $permissions = 'trip';

    protected string $model = Trip::class;

    public function index()
    {
        return $this->datatable::create($this->viewPath)->render("{$this->viewPath}.index", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
        ]);
    }

    public function indexTrack()
    {
        return $this->datatabletrack::create($this->viewPath)->render("{$this->viewPath}.indextrack", [
            'route' => $this->routeName,
            'currentLanguage' => get_current_lang(),
            'title' => "",
        ]);
    }

    public function generateTrackPDF(GenerateTrackPDFRequest $request)
    {
        $track = Track::query()
            ->whereId($request->track)
            ->withWhereHas('trips', function ($query) use ($request) {
                $query->whereDate('date', $request->date)
                    ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(origin, '$.start_time')) = ?", [$request->time]);
            })
            ->first();
        $trackTime = Carbon::parse($request->date . ' ' . $request->time)->toTimeString();
        $pdfName = 'trackreport_' . $trackTime . '.pdf';
        $merger = PDFMerger::init();
        $canMerge = false;
        foreach ($track->trips as $trip) {
            if (!is_null($trip->report->receiptPath) && str($trip->report->receiptPath)->endsWith('pdf')) {
                if(!file_exists($trip->report->receiptPath)){
                    $canMerge = false;
                    break;
                }
                $canMerge = true;
                $merger->addPDF($trip->report->receiptPath, 'all');
            }
        }
        if($canMerge){
            $merger->merge();
            $merger->setFileName($pdfName);
            return $merger->download();
        }
        else{
            return redirect()->back()->with('error',__('Missing invoices'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $helper = new MhelperClass();
        $model = $this->model::query()->whereId($id)/*->whereHas('track')*/->firstOrFail();
//        $trips = Trip::where(["track_id" => $model->track_id, "date" => $model->date])->with(["client", "track"])->get();
        $endAt = $helper->addMinutes($model->report?->duration, $model->time);

        return view($this->routeName . '.show', get_defined_vars());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTrack($id)
    {
        $helper = new MhelperClass();
        $model = $this->model::query()->whereId($id)->whereHas('track')->firstOrFail();
        $trips = Trip::where(["track_id" => $model->track_id, "date" => $model->date])->with(["client", "track"])->get();
        $endAt = $helper->addTime($model->track["destination"]["duration"], $model->track["origin"]["start_time"]);

        return view($this->routeName . '.showtrack', get_defined_vars());
    }

    public function exportTrip(Trip $trip)
    {
        return new TripSheetExport($trip);
    }

    public function exportTrackTrips(GenerateTrackPDFRequest $request)
    {
        $track = Track::query()
            ->whereId($request->track)
            ->withWhereHas('trips', function ($query) use ($request) {
                $query->whereDate('date', $request->date)
                    ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(origin, '$.start_time')) = ?", [$request->time]);
            })
            ->first();
        return new TripExport($track->trips);
    }
}
