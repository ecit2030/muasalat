<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\Client\FrequencyTransmission\FrequencyTransmissionResource;
use App\Models\FrequencyTransmission;
use App\Models\Report;
use App\Models\Trip;
use App\Services\DriversActions;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrequencyTransmissionController extends ApiController
{
    /**
     * Flow step 1.3: show available frequency trips after client sets pickup location.
     *
     * Query params:
     * - origin_lat, origin_lng: optional, to filter by nearest (range from setting general.searchRange)
     */
    public function index(Request $request)
    {
        $request->validate([
            'origin_lat' => 'nullable|numeric',
            'origin_lng' => 'nullable|numeric',
        ]);

        $radiusInKM = setting('general', 'searchRange', 5);

        $query = FrequencyTransmission::query()
            ->where('is_active', 1)
            ->where('status_driver', 1)
            ->latest('id');

        if ($request->filled('origin_lat') && $request->filled('origin_lng')) {
            $lat = (float) $request->origin_lat;
            $lng = (float) $request->origin_lng;

            // Filter by distance from the frequency transmission origin (stored as JSON: $.lat, $.lng)
            $query->where(function (Builder $builder) use ($lat, $lng, $radiusInKM) {
                $builder->whereRaw("
                    6371 * acos(
                        cos(radians(?)) * cos(radians(CAST(JSON_UNQUOTE(JSON_EXTRACT(origin, '$.lat')) AS DECIMAL(10, 7)))) *
                        cos(radians(CAST(JSON_UNQUOTE(JSON_EXTRACT(origin, '$.lng')) AS DECIMAL(10, 7))) - radians(?)) +
                        sin(radians(?)) * sin(radians(CAST(JSON_UNQUOTE(JSON_EXTRACT(origin, '$.lat')) AS DECIMAL(10, 7))))
                    ) <= ?
                ", [
                    $lat,
                    $lng,
                    $lat,
                    $radiusInKM,
                ]);
            });
        }

        return sendResponse(FrequencyTransmissionResource::collection($query->get()));
    }

    public function show(FrequencyTransmission $frequencyTransmission)
    {
        if (!((bool) $frequencyTransmission->is_active) || (int) $frequencyTransmission->status_driver !== 1) {
            return sendError(__("messages.not_found") ?: "Not found", [], 404);
        }

        return sendResponse(new FrequencyTransmissionResource($frequencyTransmission));
    }

    /**
     * Flow step 1.4/1.5: client selects frequency trip -> create a Trip + Report (unpaid).
     * Then client can pay using the existing trip pay endpoint.
     *
     * Body:
     * - origin: {lat, lng, address?}
     * - date: optional (Y-m-d). default: today
     */
    public function book(Request $request, FrequencyTransmission $frequencyTransmission)
    {
        if (!((bool) $frequencyTransmission->is_active) || (int) $frequencyTransmission->status_driver !== 1) {
            return sendError(__("messages.not_found") ?: "Not found", [], 404);
        }

        $data = $request->validate([
            'origin' => 'nullable|array',
            'origin.lat' => 'nullable|numeric',
            'origin.lng' => 'nullable|numeric',
            'origin.address' => 'nullable|string',
            'date' => 'nullable|date_format:Y-m-d',
        ]);

        $driver = $frequencyTransmission->driver;
        if (!$driver) {
            return sendError(__("messages.driver_not_found") ?: "Driver not found", [], 422);
        }

        $date = isset($data['date']) ? Carbon::parse($data['date']) : now();
        $time = Carbon::parse($frequencyTransmission->date_trans)->format('H:i:s');

        $destination = $frequencyTransmission->destination ?? null;
        if (!is_array($destination) || !isset($destination['lat'], $destination['lng'])) {
            return sendError(__("messages.invalid_destination") ?: "Invalid destination", [], 422);
        }

        $distance = (new DriversActions())->calcDistance(
            $data['origin']['lat'],
            $data['origin']['lng'],
            $destination['lat'],
            $destination['lng'],
        );

        $distance['distance'] = $distance['distance'] < 1 ? 1 : $distance['distance'];

        $kmPrice = $driver?->driverOrg ? $driver?->driverOrg?->other_price : $driver?->other_price;
        $kmPrice = (float) ($kmPrice ?? 0);

        $subtotal = (double) ($distance['distance'] * $kmPrice);
        $taxPercentage = (float) setting('general', "tax", 14);
        $taxValue = ($subtotal * $taxPercentage) / 100;
        $total = $subtotal + $taxValue;

        $trip = DB::transaction(function () use ($date, $time, $data, $destination, $frequencyTransmission, $driver, $distance, $subtotal, $taxPercentage, $taxValue, $total, $kmPrice) {
            $report = Report::create([
                "total_km" => $distance["distance"],
                "duration" => $distance["duration"],
                "sub_total" => $subtotal,
                "tax_value" => $taxValue,
                "tax" => $taxPercentage,
                "total" => $total,
                "payment_method" => 'not paid',
                "km_price" => $kmPrice,
                "reservation_type" => 'frequency',
                "start_date" => $date->format('Y-m-d'),
                "end_date" => $date->format('Y-m-d'),
                "is_paid" => 0,
            ]);

            return Trip::create([
                'client_id' => auth()->id(),
                'driver_id' => $driver->id,
                'report_id' => $report->id,
                'date' => $date->format('Y-m-d'),
                'time' => $time,
                'origin' => $data['origin'],
                'destination' => $destination,
                'parent_id' => 0,
                'trip_type' => 'frequency',
            ]);
        });

        return sendResponse($trip, __("messages.resource_created"));
    }
}

