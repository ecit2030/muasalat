<?php

namespace App\Http\Resources\Api\Screen\Sidebar\Setting;

use App\Support\Api\Resource\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class MyNotificationResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $data['title'] = $this->data["title"][app()->getLocale()] ?? $this->data["title"];
        $data['message'] = $this->data["message"][app()->getLocale()] ?? $this->data["message"];
        $data['notifier_id'] = $this->data["notifier_id"] ?? null;
        $data['data'] = $this->data["data"] ?? [];
        return [
            "id" => $this->id,
            "type" => $this->type,
            "notifiable_type" => $this->notifiable_type,
            "notifiable_id" => $this->notifiable_id,
            "data" => $data,
            "read_at" => $this->read_at ,
            "created_at" => $this->created_at ,
            "updated_at" => $this->updated_at ,
        ];
    }
}
