<?php

namespace App\Http\Resources\Api\Client\Trip;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class TalebatSearchResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            "owner" => [
                'id' => $this->id,
                'name' => $this->name,
                'role' => $this->roles()->first()->name,
                'avatar' => $this->getFirstMediaUrl("avatar"),
                'rate' => (int)$this->rate,
                'price' => request()->has("type") && request("type") == "talebat" ? $this->talebat_price : $this->other_price
            ],

            'name' => $this->name,
            'origin' => $this->tracks()?->first()?->origin,
            'destination' => $this->tracks()->first()->destination,
            'vehicleCapcity' => (int)$this->vehicleCapacity,
            "occupaiedCapacity" => (int)$this->occupaiedCapacity,
            "validCapacity" => (int)$this->validCapacity,
            "tracks" => $this->trips,

            "totalKm" => $this->totalKm,
            "totalPrice" => $this->totalPrice + .5,

            "reviews" => TripReviewResource::collection($this->orgTrips()->where("rate", ">", 0)->whereNotNull('comment')->get())

        ];
    }
}
