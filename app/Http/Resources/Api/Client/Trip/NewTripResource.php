<?php

namespace App\Http\Resources\Api\Client\Trip;

use App\Models\Chat;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;
use Carbon\Carbon;

class NewTripResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        Carbon::setLocale(app()->getLocale());

        $report = new ReportResource($this->report);
        $additional = [
            'name' => $this->client?->name ?? '',
            'start_time' => Carbon::parse($this->start_at)->translatedFormat('h:i a'),
            'end_time' => Carbon::parse($this->end_at)->translatedFormat('h:i a'),
        ];
        if ($this->report?->reservation_type == 'talebat') {
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
            'date' => Carbon::parse($this->date)->format('Y-m-d'),
            'time' => $this->time,
            'rate' => $this->rate,
            'is_delivered_to_client' => $this->is_delivered_to_client,
            'comment' => $this->comment,
            "origin" => $origin,
            "destination" => $destination,
            "parent_id" => $this->parent_id,
            "startAt" => $this->start_at,
            "endAt" => $this->end_at,
            "driver" => $this->driver ? CaptainModelResource::make($this->driver) : null,
            "is_canceled" => $this->is_canceled,
            "cancel_reason" => $this->cancel_reason,
            "chatId" => $this->chat?->id ?? 0,
            "canChat" => $this->driver == 'current' ? true : false,
            'repeat' => $this->report?->reservation_type != 'other' ? $this->report?->trips->map(function ($trip) {
                return [
                    'id' => $trip->id,
                    'date' => $trip->date,
                    'day_in_week' => Carbon::parse($trip->date)->translatedFormat('l'),
                    'time' => $trip->time,
                    'start_at' => $trip->start_at,
                    'end_at' => $trip->end_at,
                    'is_canceled' => $trip->is_canceled,
                    'cancel_reason' => $trip->cancel_reason,
                    'trip_type' => $trip->trip_type,
                ];
            }) : []
        ];
    }
}
