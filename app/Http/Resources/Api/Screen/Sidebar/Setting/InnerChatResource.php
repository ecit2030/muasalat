<?php

namespace App\Http\Resources\Api\Screen\Sidebar\Setting;

use App\Support\Api\Resource\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class InnerChatResource extends JsonResource
{
    use WithPagination;

    public function toArray($request)
    {
        $isSenderMe = auth('sanctum')->id() == $this->user_id ? "true" : "false";
        return [
            "message"  => $this->message ?? '',
            "readAt"  => $this->read_at ?? '',
            "isRead"  => $this->read_at ? "true" : "false",
            "isSenderMe"  => $isSenderMe ,
            "messageDate" => $this->created_at?->format('Y-m-d H:i:s') ?? '',
        ];
    }
}
