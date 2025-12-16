<?php

namespace App\Http\Resources\Api\Captain\Trip;

use App\Http\Resources\Api\Captain\Track\WaypointResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class TrackTripResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $newestTrip = $this->trips->sortBy([
            ['date', 'desc']
        ])->first();

        $startTime = $newestTrip->origin['start_time'];
        $duration = $newestTrip->destination['duration'];
        $splitDuration = explode(':', $duration);

        $startAt = Carbon::parse($newestTrip->date . ' ' . $startTime);
        $endAt = Carbon::parse($newestTrip->date . ' ' . $startTime)->addHours($splitDuration[0])->addMinutes($splitDuration[1]);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => $newestTrip->date,
            'rate' => auth()->user()->rate ?? 0,
            "startAt" => $startAt->translatedFormat('Y-m-d H:i'),
            "endAt" => $endAt->translatedFormat('Y-m-d H:i'),
            'canStart' => now()->gte($startAt->subMinutes(10)) && is_null($newestTrip->start_at) ? true : false,
            'canFinish' => (now()->lte($endAt->subMinutes(10)) || now()->gte($endAt)) && (!is_null($newestTrip->start_at) && is_null($newestTrip->end_at)) ? true : false,
            'active' => $this->is_active ? "true" : "false",
            'distance' => number_format($this->distance ?? '0.00', 2),
            'origin' => $this->origin,
            'destination' => $this->destination,
            'repeat' => $this->repeat,
            'waypoints' => WaypointResource::collection($this->waypoints),
            'trips' => TripDetailsResource::collection($this->trips),
        ];
    }
}
