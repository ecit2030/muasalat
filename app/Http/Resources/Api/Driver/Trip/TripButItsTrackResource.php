<?php

namespace App\Http\Resources\Api\Driver\Trip;

use App\Models\Trip;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;
use Carbon\Carbon;
use DB;

class TripButItsTrackResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $duration = explode(':', $this->destination["duration"]);
        $time = explode(':', $this->origin["start_time"]);
        $today = Carbon::today()->format('Y-m-d');
        $objDate = $this->date;

        if (gettype($this->date) == "object") {
            $objDate =  $this->date->date;
        };

        $date = explode('-', $objDate ?? $today);

        $dateTimeStartOTrip = Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1], 0);

        $dateTimeEndOTrip = Carbon::create($date[0], $date[1], $date[2], $time[0], $time[1], 0)->addHours($duration[0])->addMinutes($duration[1]);

        $clients = Trip::select("client_id", "date", "track_id")->distinct("client_id")->where(["track_id" => $this->id, "date" => $objDate ?? $today])->get();

        $hasNofinishedTrips = auth()->user()->driverTrips()->withTrashed()->select('trips.id')->whereNotNull("start_at")->whereNull("end_at")->count() == 0;

        $tripIsOnTodayInMinutes = Carbon::now() >= $dateTimeStartOTrip->subMinutes(15);

        $timeOfFinishIsUp =  Carbon::now() >  $dateTimeEndOTrip->subMinutes(10);

        $tripModel = $this->trips()->where("date", "=", $objDate ?? $today)->withTrashed()->first();

        $tripAlreadyStarted = $tripModel?->start_at != null;

        $date = $objDate ?? $tripModel?->date;

        return [
            'id' => $this->id,
            "track" => new TrackResource($this),
            'date' =>  $request?->date ??  $objDate ?? $tripModel?->date ?? $today,
            'rate' => $this?->rate ?? 0,
            "startAt" => $tripModel?->start_at,
            "endAt" => $tripModel?->end_at,
            "clients" => TripClientResource::collection($clients),
            "canStart" => $tripIsOnTodayInMinutes && $tripModel?->start_at == null ? "true" : "false",
            "canFinish" => $timeOfFinishIsUp && $tripAlreadyStarted && $tripModel?->end_at == null ? "true" : "false"
        ];
    }
}
