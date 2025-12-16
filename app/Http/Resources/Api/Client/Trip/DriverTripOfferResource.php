<?php

namespace App\Http\Resources\Api\Client\Trip;

use Illuminate\Http\Resources\Json\JsonResource;

class DriverTripOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this?->id,
            'status' => $this?->status,
            'driver' => CaptainModelResource::make($this->driver),
        ];
    }
}
