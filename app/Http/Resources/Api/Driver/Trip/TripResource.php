<?php

namespace App\Http\Resources\Api\Driver\Trip;

use App\Models\Trip;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;
use Carbon\Carbon;

class TripResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $duration = explode(':', $this->track->destination["duration"]);
        $time = explode(':', $this->track->origin["start_time"]);
        $finishTime = Carbon::createFromTime((+$duration[0]), (+$duration[1]), 0)->addHours($time[0])->addMinutes($time[1]);

        $clients = Trip::select("client_id" , "date" , "track_id")->distinct("client_id")->where(["track_id" => $this->track_id, "date" => $this->date, "start_at" => $this->start_at, "end_at" => $this->end_at])->get();
        $hasNofinishedTrips = auth()->user()->driverTrips()->select('trips.id')->whereNotNull("start_at")->whereNull("end_at")->count() == 0;
        $tripIsOnTodayInMinutes = $this->date == Carbon::now()->format("Y-m-d") &&  Carbon::now() >= Carbon::createFromTime($time[0], $time[1], 0)->subMinutes(15)->format("H:i");
        $timeOfFinishIsUp = $finishTime->subMinutes(10)->format("H:i") > Carbon::now()->format("H:i")  || Carbon::now()->format("H:i") >  $finishTime->format("H:i");
        $tripAlreadyStarted = $this->start_at != null;

        return [
            'id' => $this->id,
            "track" => new TrackResource($this->track),
            'date' => $this->date,
            'rate' => $this->rate,
            "startAt" => $this->start_at,
            "endAt" => $this->end_at,
            "clients" => TripClientResource::collection($clients),
            "canStart" => $tripIsOnTodayInMinutes && $this->start_at == null ? "true" : "false",
            "canFinish" => $timeOfFinishIsUp && $tripAlreadyStarted && $this->end_at == null ? "true" : "false"
        ];
    }
}
