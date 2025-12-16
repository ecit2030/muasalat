<?php

namespace App\Http\Resources\Api\Captain\Trip;

use App\Http\Resources\Api\Captain\Track\WaypointResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class TrackResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'active' => $this->is_active ? "true" : "false",
            'distance' => number_format($this->distance ?? '0.00', 2, '.', ''),
            'origin' => $this->origin,
            'destination' => $this->destination,
            'repeat' => $this->repeat,
            'waypoints' => WaypointResource::collection($this->waypoints),
        ];
    }
}
