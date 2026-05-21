<?php

namespace App\Http\Resources\Api\Client\Trip;

use App\Support\Api\Resource\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagementChatMessagesResource extends JsonResource
{
    use WithPagination;

    public function toArray($request)
    {
        $isSenderMe = auth('sanctum')->id() == $this->user_id ? "true" : "false";
        return [
            "id"  => $this->id,
            "message"  => $this->message ?? '',
            "readAt"  => $this->read_at ?? '',
            "isRead"  => $this->read_at ? "true" : "false",
            "isSenderMe"  => $isSenderMe ,
            "user_id"  => $this->user_id ,
            "messageDate" => $this->created_at->format('Y-m-d') ?? '',
            "messageTime" => $this->created_at->format('H:i') ?? '',
        ];
    }
}
