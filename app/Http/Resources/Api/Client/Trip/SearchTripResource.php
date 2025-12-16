<?php

namespace App\Http\Resources\Api\Client\Trip;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class SearchTripResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $split = explode(':', $this->destination["duration"] ?? '00:00');
        $endTime = Carbon::createFromFormat('H:i', $this->origin["start_time"] ?? '00:00')
            ->addHours($split[0])->addMinutes($split[1])->format('H:i');
        return [
            "owner" => [
                'id' => $this->owner->id,
                'name' => $this->owner->name,
                'role' => $this->owner->roles()->first()->name,
                'avatar' => $this->owner->getFirstMediaUrl("avatar"),
                'rate' => (int)$this->owner->rate,
                'price' => request()->has("type") && request("type") == "talebat" ? $this->owner->talebat_price : $this->owner->other_price

            ],

            'name' => $this->name,
            'origin' => $this->origin,
            'rate' => (int)$this->rate,
            'destination' => $this->destination,
            'vehicleCapcity' => (int)$this->vehicle->year->model->capacity,
            "occupaiedCapacity" => (int)$this->occupaiedCapacity,
            "validCapacity" => (int)$this->validCapacity,

            "tracks" => [
                [
                    'track_id' => $this->id,
                    'name' => $this->name,
                    'origin' => $this->origin,
                    'destination' => $this->destination,
                    "start_time" => $this->origin["start_time"] ?? '00:00',
                    "end_time" => $endTime,
                    'date' => $this->date,
                    "distance" => number_format($this->distance ?? '0.00', 2) ?? '0.00',
                ]
            ],

            "totalPrice" => $this->totalPrice,

            "reviews" => TripReviewResource::collection($this->owner->orgTrips()->where("rate", ">", 0)->whereNotNull('comment')->get())
        ];
    }
}
