<?php

namespace App\Http\Resources\Api\Captain\FrequencyTransmission;

use Illuminate\Http\Resources\Json\JsonResource;

class FrequencyTransmissionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'driver_id' => $this->driver_id,
            'vehicle_id' => $this->vehicle_id,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'repeat' => $this->repeat,
            'relay_point' => $this->relay_point,
            'details' => $this->details,
            'oneway_price' => $this->oneway_price !== null ? (float) $this->oneway_price : null,
            'round_price' => $this->round_price !== null ? (float) $this->round_price : null,
            'date_trans' => optional($this->date_trans)->toDateTimeString() ?? $this->date_trans,
            'status_driver' => (int) $this->status_driver,
            'is_active' => (bool) $this->is_active,
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}

