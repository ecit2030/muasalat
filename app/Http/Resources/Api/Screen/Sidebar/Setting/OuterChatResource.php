<?php

namespace App\Http\Resources\Api\Screen\Sidebar\Setting;

use App\Models\ChatMessage;
use App\Models\Trip;
use App\Support\Api\Resource\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

class OuterChatResource extends JsonResource
{
    use WithPagination;

    public function toArray($request)
    {
        $otherPartner = auth()->id() == $this->sender_id ? $this->receiver : $this->sender;
        $message = $this->messages->isNotEmpty() ? $this->messages->last() : null;
        $senderIsMe = auth()->id() == optional($message)->user_id;

//        $canChat = false;
//        if (auth()->user()->hasRole('user')) {
//            if (Trip::whereClientId(auth()->id())
//                ->whereNotNull('start_at')
//                ->whereNull('end_at')
//                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(origin, '$.start_time')) > ? AND date = ? AND client_id = ?", [now()->format('H:i'), now()->toDateString(), auth()->id()])
//                ->whereDate('date', now()->toDateString())->whereRelation('track', 'driver_id', '=', $otherPartner->id)->exists())
//                $canChat = true;
//        } else {
//            if (Trip::whereClientId($otherPartner->id)
//                ->whereNotNull('start_at')
//                ->whereNull('end_at')
//                ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(origin, '$.start_time')) > ? AND date = ? AND client_id = ?", [now()->format('H:i'), now()->toDateString(), $otherPartner->id])
//                ->whereDate('date', now()->toDateString())->whereRelation('track', 'driver_id', '=', auth()->id())->exists())
//                $canChat = true;
//        }
        return [
            "id" => $this->id ?? 0,
            "LastMessage" => optional($message)->message ?? '',
            "LastMessageDate" => optional($message)->created_at ? optional($message)->created_at?->format('Y-m-d H:i:s') : '',
            "isSeen" => optional($message)->read_at || $senderIsMe ? "true" : "false",
            "receiverId" => $otherPartner->id ?? 0,
            "name" => $otherPartner->name ?? '',
            "avatar" => $otherPartner->avatar ?? '',
//            "can_chat" => $canChat,
        ];
    }
}
