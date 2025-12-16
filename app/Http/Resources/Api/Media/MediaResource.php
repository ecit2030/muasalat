<?php

namespace App\Http\Resources\Api\Media;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (int) $this->id,
            'uuid' => (string) $this->uuid,
            'name' => (string) $this->name,
            'extension' => (string) $this->extension,
            'size' => (string) $this->size,
            'mime_type' => (string) $this->mime_type,
            'url' => (string) $this->getUrl(),
        ];
    }
}
