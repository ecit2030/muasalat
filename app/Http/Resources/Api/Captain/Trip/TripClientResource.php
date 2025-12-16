<?php

namespace App\Http\Resources\Api\Captain\Trip;

use App\Models\Chat;
use App\Models\Trip;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;
use Carbon\Carbon;

class TripClientResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $ids = Trip::select(["id", "track_id"])->with(['track:id,name' => ['driver:id,name', 'owner:id,name']])->where(["client_id" => $this->client_id, "track_id" => $this->track_id, "date" => $this->date])->get();

        $chatId = Chat::select("id")->where(function ($q) {
            $q->where(["sender_id" => auth()->id(), "receiver_id" => $this->client->id]);
        })->orWhere(function ($q) {
            $q->where(["receiver_id" => auth()->id(), "sender_id" => $this->client->id]);
        })?->first()?->id;

        $report = new ReportResource($this->report);
        $additional = [
            'name' => $this->client->name,
            'driver' => optional(optional(optional(optional($ids)->first())->track)->driver)->name ?? optional(optional(optional(optional($ids)->first())->track)->owner)->name ?? '',
            'track' => $ids->first()->track->name,
            'start_time' => Carbon::parse($ids->first()->start_at)->translatedFormat('h:i a'),
            'end_time' => Carbon::parse($ids->first()->end_at)->translatedFormat('h:i a'),
        ];
        if ($this->report->reservation_type == 'talebat') {
            $additional['start_at'] = Carbon::parse($ids->first()->start_at)->translatedFormat('Y-m-d');
            $additional['end_at'] = Carbon::parse($ids->last()->end_at)->translatedFormat('Y-m-d');
        }
        $report = $report->additional($additional);
        return [
            'report' => $report,
            'id' => $this->client->id,
            "chatId" => $chatId ?? 0,
            "canChat" => now()->gte(Carbon::parse($ids->first()->start_at)) && now()->lte(Carbon::parse($ids->first()->end_at)) ? true : false,
            "bookIds" => $ids->pluck("id"),
            "bookCount" => $ids->count(),
            'avatar' => $this->client->getFirstMediaUrl('avatar'),
            'name' => $this->client->name,
            'phone' => $this->client->phone,
        ];
    }
}
