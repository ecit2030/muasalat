<?php

namespace App\Http\Resources\Api\Client\Trip;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Support\Api\Resource\WithPagination;

class ReportResource extends JsonResource
{
    use WithPagination;

    public function toArray($request): array
    {
        $data = [
            "id" => $this->id,
            "created_at" => $this->created_at->translatedFormat('Y-m-d'),
            "km_price" => $this->km_price,
            "sub_total" => $this->sub_total,
            "tax_value" => (double)number_format($this->tax_value,2),
            "tax" => $this->tax,
            "total" => (double)number_format($this->total,2),
            "receipt" => $this->receipt,
            "qr" => $this->qr,
            "invoice_link" => url('/client/trip/get-details-pdf/' . $this->id . '/' . get_current_lang()),
            "duration" => $this->duration,
            "total_km" => $this->total_km,
            "is_paid" => $this->is_paid,
            "payment_method" => __('messages.'.$this->payment_method),
            "reservation_type" => $this->reservation_type,
            "start_date" => Carbon::parse($this->start_date)->format('Y-m-d'),
            "end_date" => Carbon::parse($this->end_date)->format('Y-m-d'),
            "accepted_time" => $this->accepted_time,
            "accepted_time_for_driver" => $this->accepted_time_for_driver,
            'client_trip_payment_time_before_cancel' => setting('general', 'client_trip_payment_time_before_cancel', 5),
            'search_time' => setting('general', 'captain_accept_reject_time', 5),
        ];
        if(!empty($this->additional))
            $data = array_merge($data ,$this->additional);
        return $data;
    }
}
