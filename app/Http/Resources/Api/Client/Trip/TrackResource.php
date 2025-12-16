<?php

namespace App\Http\Resources\Api\Client\Trip;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class TrackResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $data = [
            'id'=>$this->id,
            'name'=>$this->name,
            'active'=>$this->is_active ? "true" : "false",
            'origin'=> $this->origin,
            'destination'=> $this->destination,
            'repeat'=> $this->repeat,
            'waypoints'=> WaypointResource::collection($this->waypoints),
            $this->mergeWhen($request->has('filter') && $request->input('filter') === 'current' , [
                'mapRouteData'=> $this->makeVisible(['map_route_data'])->map_route_data,
            ]),
        ];
        $data['mapRouteData'] = $request->has('filter') && $request->input('filter') === 'current' ? $this->makeVisible(['map_route_data'])->map_route_data : [];
        return $data;
    }
}
