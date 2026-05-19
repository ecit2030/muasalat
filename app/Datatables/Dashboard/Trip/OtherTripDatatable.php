<?php

namespace App\Datatables\Dashboard\Trip;

use Illuminate\Database\Eloquent\Builder;

/**
 * One-off / مشوار trips (report reservation_type "other").
 */
class OtherTripDatatable extends TripDatatable
{
    protected function filterByReservationType(Builder $data): void
    {
        $data->whereHas('report', function ($qr) {
            $qr->where('reservation_type', 'other');
        });
    }
}
