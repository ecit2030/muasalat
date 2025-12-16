<?php

namespace Modules\Student\Http\Resources;

use App\Http\Resources\Api\Client\Trip\TrackResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class NotificationResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->data["title"][app()->getLocale()] ?? $this->data["title"],
            'message' => $this->data["message"][app()->getLocale()] ?? $this->data["message"],
            'data' => $this->data['data'] ?? [],
            "isRead"=> $this->read_at ? "true" : "false",
            'readAt' => $this?->read_at ? $this?->read_at->format('Y-m-d H:i:s') : '',
            'createdAt' => $this->created_at->format('Y-m-d H:i:s') ?? '',
        ];
    }
}
