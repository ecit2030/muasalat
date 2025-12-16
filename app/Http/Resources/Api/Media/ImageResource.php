<?php

namespace App\Http\Resources\Api\Media;

use App\Support\Api\Resource\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ImageResource */
class ImageResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            'uuid' => (int) $this->uuid,
            'name' => (string) data_get($this, 'name'),
            'url' => (string) data_get($this, 'original_url'),
            'extension' => (string) data_get($this, 'extension'),
            'size' => (int) data_get($this, 'size'),
        ];
    }
}
