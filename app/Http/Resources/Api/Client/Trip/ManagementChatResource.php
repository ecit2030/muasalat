<?php

namespace App\Http\Resources\Api\Client\Trip;

use App\Support\Api\Resource\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagementChatResource extends JsonResource
{
    use WithPagination;

    public function toArray($request)
    {
        return [
            "id"  => $this->id,
            "sender_id"  => $this->sender_id,
            "receiver_id"  => $this->receiver_id,
            "trip_id"  => $this->trip_id,
            "messages"  => ManagementChatMessagesResource::collection($this->messages),
        ];
    }
}
