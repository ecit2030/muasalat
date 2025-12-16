<?php

namespace App\Http\Resources\Api\Client\Trip;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class TripReviewResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            'id' => $this->client?->id,
            'name' => $this->client?->name,
            'avatar' => $this->client?->getFirstMediaUrl("avatar"),
            'rate' => $this->rate,
            'comment' => $this->comment,
        ];
    }
}
