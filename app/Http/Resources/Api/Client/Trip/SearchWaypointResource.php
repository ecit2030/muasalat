<?php

namespace App\Http\Resources\Api\Client\Trip;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class SearchWaypointResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            'location' => $this->waypoint["location"],
            'lat' => $this->waypoint["lat"],
            'lng' => $this->waypoint["lng"],
            'distance' => number_format($this->waypoint["distance"] ?? '0.00', 2, '.', '') ?? '0.00',
            'duration' => $this->waypoint["duration"],
        ];
    }
}
