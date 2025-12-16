<?php

namespace App\Http\Resources\Api\Client\Trip;

use App\Models\Chat;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;
use Carbon\Carbon;

class TripResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $id = $this?->driver?->id;
        $chatId = Chat::select("id")->where(function ($q) use ($id) {
            $q->where(["sender_id" => auth()->id(), "receiver_id" => $id]);
        })->orWhere(function ($q) use ($id) {
            $q->where(["receiver_id" => auth()->id(), "sender_id" => $id]);
        })?->first()?->id;

        if (!$chatId) {
            $chat = Chat::create([
                "sender_id" => auth()->id(),
                "receiver_id" => $id,
            ]);
            $chatId = $chat->id;
        }

        $report = new ReportResource($this->report);
        $additional = [
            'name' => $this->client?->name ?? '',
            'driver' => $this->track?->driver?->name ?? $this->track?->owner?->name ?? '',
            'track' => $this->track?->name ?? '',
            'start_time' => Carbon::parse($this->start_at)->translatedFormat('h:i a'),
            'end_time' => Carbon::parse($this->end_at)->translatedFormat('h:i a'),
        ];
        if ($this->report->reservation_type == 'talebat') {
            $additional['start_at'] = Carbon::parse($this->start_at)->translatedFormat('Y-m-d');
            $additional['end_at'] = Carbon::parse($this->end_at)->translatedFormat('Y-m-d');
        }
        $report = $report->additional($additional);

        $origin = $this->origin;
        $origin['distance'] = number_format($origin['distance'] ?? '0.00', 2, '.', '') ?? '0.00';
        $destination = $this->destination;
        $destination['distance'] = number_format($destination['distance'] ?? '0.00', 2, '.', '') ?? '0.00';

        return [
            'id' => $this->id,
            'report' => $report,
            $this->mergeWhen(!is_null($this->status), [
                'status' => $this->status ?? '',
            ]),
            "track" => new TrackResource($this->track),
            'date' => $this->date,
            'rate' => $this->rate,
            "origin" => $origin,
            "destination" => $destination,
            "startAt" => $this->start_at,
            "endAt" => $this->end_at,

            "driver" => [
                "id" => $this?->track?->driver?->id ?? $this->track->owner->id,
                "name" => $this?->track?->driver?->name ?? $this->track->owner->name,
                "phone" => $this?->track?->driver?->phone ?? $this->track->owner->phone,
                "avatar" => $this?->track?->driver?->getFirstMedia('avatar')?->getUrl() ?? $this->track->owner->getFirstMedia('avatar')?->getUrl(),
                "rate" => $this?->track?->driver?->rate ?? $this->track->owner->rate,
            ],

            "organization" => [
                "id" => $this->track->owner->id,
                "name" => $this->track->owner->name,
                "phone" => $this->track->owner->phone,
                "avatar" => $this->track->owner->getFirstMedia('avatar')?->getUrl(),
                "rate" => $this->track->owner->rate,
            ],

            "chatId" => $chatId ?? 0,
            "canChat" => $this->status == 'current' ? true : false,
        ];
    }
}
