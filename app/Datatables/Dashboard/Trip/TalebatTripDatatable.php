<?php

namespace App\Datatables\Dashboard\Trip;

use Illuminate\Database\Eloquent\Builder;

/**
 * Monthly subscription (طالبات / talebat) trips for the dashboard listing.
 */
class TalebatTripDatatable extends TripDatatable
{
    protected function filterByReservationType(Builder $data): void
    {
        $data->whereHas('report', function ($qr) {
            $qr->where('reservation_type', 'talebat');
        });
    }
}
