<?php

namespace App\Http\Resources\Api\Driver\Trip;

use App\Models\Chat;
use App\Models\Trip;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class TripClientResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $ids = Trip::select("id")->where(["client_id" => $this->client_id, "track_id" => $this->track_id, "date" => $this->date])->get();

        $chatId = Chat::select("id")->where(function ($q) {
            $q->where(["sender_id" => auth()->id(), "receiver_id" => $this->client->id]);
        })->orWhere(function ($q) {
            $q->where(["receiver_id" => auth()->id(), "sender_id" => $this->client->id]);
        })?->first()?->id;

        return [
            'id' => $this->client?->id,
            "bookIds" => $ids->pluck("id"),
            "bookCount" => $ids->count(),
            'name' => $this->client?->name,
            'avatar' => $this->client?->getFirstMediaUrl('avatar'),
            'phone' => $this->client?->phone,
            "chatId" => $chatId ?? 0,
        ];
    }
}
