<?php

namespace App\Http\Resources\Api\Captain\Trip;

use App\Models\Trip;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;
use Carbon\Carbon;

class TripButItsTrackResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $duration = explode(':', $this->destination["duration"]);
        $time = explode(':', $this->origin["start_time"]);
        $today = Carbon::today()->translatedFormat('Y-m-d');
        $finishTime = Carbon::createFromTime((+$time[0]), (+$time[1]), 0)->addHours($duration[0])->addMinutes($duration[1]);

        $objDate = $this->date;
        if (gettype($this->date) == "object") {
            $objDate = $this->date->date;
        };

        $clients = Trip::select("client_id", "report_id", "date", "track_id")->distinct("client_id")->where(["track_id" => $this->id, "date" => $objDate ?? $today])->with('report')->get();
        $hasNofinishedTrips = auth()->user()->captainTrips()->withTrashed()->select('trips.id')->whereNotNull("start_at")->whereNull("end_at")->count() == 0;
        $tripIsOnTodayInMinutes = Carbon::now()->format("H:i") >= Carbon::createFromTime($time[0], $time[1], 0)->subMinutes(15)->format("H:i");
        $timeOfFinishIsUp = $finishTime->subMinutes(10)->format("H:i") > Carbon::now()->format("H:i") || Carbon::now()->format("H:i") > $finishTime->format("H:i");
        $tripModel = $this->trips()->where("date", "=", $objDate ?? $today)->withTrashed()->first();
        $tripAlreadyStarted = $tripModel?->start_at != null;
        $date = $objDate ?? $tripModel?->date;
        $tripIsToday = $date == $today;

        return [
            'id' => $this->id,
            'reservation_type' => optional(optional(optional($clients)->first())->report)->reservation_type ?? '',
            "track" => new TrackResource($this),
            'date' => $tripModel?->date ?? $objDate ?? $today,
            'rate' => $tripModel?->rate ?? 0,
            "startAt" => $tripModel?->start_at,
            "endAt" => $tripModel?->end_at,
            "clients" => TripClientResource::collection($clients),
            "canStart" => $tripIsOnTodayInMinutes && $this->start_at == null ? "true" : "false",
            "canFinish" => $timeOfFinishIsUp && $tripAlreadyStarted && $this->end_at == null ? "true" : "false"
        ];
    }
}
