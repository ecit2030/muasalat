<?php

namespace App\Http\Resources\Api\Captain\Trip;

use App\Http\Resources\Api\Client\Trip\ReportResource;
use App\Http\Resources\Api\Screen\Sidebar\Setting\ChatResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;
use Carbon\Carbon;

class TripV2Resource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {

        $origin = $this->origin;
        $origin['distance'] = number_format($origin['distance'] ?? '0.00', 2, '.', '') ?? '0.00';
        $destination = $this->destination;
        $destination['distance'] = number_format($destination['distance'] ?? '0.00', 2, '.', '') ?? '0.00';

        $report = new ReportResource($this->report);

        $additional = [
            'name' => $this->client?->username ?? '',
            'avatar' => $this->client?->avatar ?? '',
            'start_time' => Carbon::parse($this->start_at)->translatedFormat('h:i a'),
            'end_time' => Carbon::parse($this->end_at)->translatedFormat('h:i a'),
        ];

        $report = $report->additional($additional);

        Carbon::setLocale(app()->getLocale());

        return [
            'id' => $this->id,
            'date' => Carbon::parse($this->date)->format('Y-m-d'),
            'is_delivered_to_client' => $this->is_delivered_to_client,
            'time' => $this->time,
            'rate' => $this->rate,
            'comment' => $this->comment,
            "startAt" => $this->start_at,
            "endAt" => $this->end_at,
            "origin" => $origin,
            "is_canceled" => $this->is_canceled,
            "cancel_reason" => $this->cancel_reason,
            "chat" => ChatResource::make($this->chat),
            "destination" => $destination,
            'report' => $report,
            'tripTotal' => $this->tripTotal,
            'status' => $this->getStatus(
                $this->start_at,
                $this->end_at,
                $this->is_canceled,
                $this->date,
                $this->time,
                $this->report?->is_paid
            ),
            'mine' => (bool)$this->driver_id,
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
                    'status' => $this->getStatus(
                        $trip->start_at,
                        $trip->end_at,
                        $trip->is_canceled,
                        $trip->date,
                        $trip->time,
                        $this->report?->is_paid
                    ),
                ];
            }) : []
        ];
    }

    public function getStatus($start_at, $end_at, $is_canceled, $date, $time,$is_paid = 0): string
    {
        if ($is_canceled)
            return 'is_canceled';

        $currentDate = Carbon::today();
        $givenDate = Carbon::parse($date);

        if (is_null($start_at) && is_null($end_at) && $currentDate->equalTo($givenDate)) {
            $currentTime = Carbon::now();
            $givenTime = Carbon::parse($time);

            if (
                (($givenTime->greaterThanOrEqualTo($currentTime) && 
                $givenTime->lessThanOrEqualTo($currentTime->addHour())) || 
                $currentTime->lessThanOrEqualTo($givenTime->addMinutes(15))) && $is_paid == 1
            ) {
                return 'show_button';
            }
        }

        if (!is_null($start_at) && !is_null($end_at)) {
            return 'trip_ended';
        }

        if ($date < $currentDate->format('Y-m-d') && ((is_null($start_at) && !is_null($end_at)) || (is_null($start_at) && is_null($end_at)))) {
            return 'previous_trip';
        }

        if (!is_null($start_at) && is_null($end_at)) {
            return 'trip_started';
        }


        return 'new';

    }
}
