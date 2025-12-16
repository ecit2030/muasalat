<?php

namespace App\Http\Resources\Api\Screen\Sidebar\Setting;

use App\Http\Resources\Api\Client\Trip\ManagementChatMessagesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"  => $this->id,
            "receiver_id"  => $this->sender?->id,
            "receiver_name"  => $this->sender?->name,
            "receiver_phone"  => $this->sender?->phone,
            "receiver_image"  => $this->sender?->avatar,
        ];
    }
}
