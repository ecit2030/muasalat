<?php

namespace App\Http\Resources\Api\Captain\Trip;

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
            "tax_value" => $this->tax_value . " %",
            "tax" => $this->tax,
            "total" => $this->total,
            "receipt" => $this->receipt,
            "qr" => $this->qr,
        ];
         if(!empty($this->additional))
             $data = array_merge($data ,$this->additional);
         return $data;
    }
}
