<?php

namespace App\Http\Resources\Api\Captain\Trip;

use App\Models\Chat;
use App\Models\Trip;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;
use Carbon\Carbon;

class TripDetailsResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $chatId = Chat::select("id")->where(function ($q) {
            $q->where(["sender_id" => auth()->id(), "receiver_id" => $this->client->id]);
        })->orWhere(function ($q) {
            $q->where(["receiver_id" => auth()->id(), "sender_id" => $this->client->id]);
        })?->first()?->id;

        $splitTime = explode(':', $this->destination['duration']);
        $report = new ReportResource($this->report);
        $startTime = Carbon::parse($this->date . ' ' . $this->origin['start_time']);
        $endTime = Carbon::parse($this->date . ' ' . $this->origin['start_time'])->addHours($splitTime[0])->addMinutes($splitTime[1]);
        $additional = [
            'name' => $this->client->name,
            'driver' => $this->track?->driver?->name ?? $this->track?->owner?->name ?? '',
            'track' => $this->track?->name,
            'start_time' => $startTime->translatedFormat('h:i a'),
            'end_time' => $endTime->translatedFormat('h:i a'),
        ];
        $ids = Trip::select(["id", "track_id"])->with(['track:id,name' => ['driver:id,name', 'owner:id,name']])->where(["client_id" => $this->client_id, "track_id" => $this->track_id, "date" => $this->date])->get();
        if ($this->report->reservation_type == 'talebat') {
            $additional['start_at'] = Carbon::parse($ids->first()->start_at)->translatedFormat('Y-m-d');
            $additional['end_at'] = Carbon::parse($ids->last()->end_at)->translatedFormat('Y-m-d');
        }
        $report = $report->additional($additional);
        return [
            'report' => $report,
            'date' => $this->date,
            'start_time' => $this->origin['start_time'],
            'duration' => $this->destination['duration'],
            'reservation_type' => __('' . $this->report->reservation_type),
            'rate' => $this->rate ?? 0,
            "chatId" => $chatId ?? 0,
            "canChat" => now()->gte($startTime) && now()->lte($endTime) ? true : false,
            "bookIds" => $ids->pluck("id")->toArray() ?? [],
            "bookCount" => $ids->count(),
            'clientId' => $this->client->id,
            'avatar' => $this->client->getFirstMediaUrl('avatar'),
            'name' => $this->client->name,
            'phone' => $this->client->phone,
        ];
    }
}
