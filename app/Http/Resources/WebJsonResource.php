<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class WebJsonResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
