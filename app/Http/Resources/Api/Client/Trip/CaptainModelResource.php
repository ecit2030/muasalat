<?php

namespace App\Http\Resources\Api\Client\Trip;

use Illuminate\Http\Resources\Json\JsonResource;

class CaptainModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $veichel = !$this->driverVehicle ? null : [

            "brandId" => $this?->driverVehicleYear?->model?->brand?->id,
            "brand" => $this?->driverVehicleYear?->model?->brand?->name,
            "modelId" => $this?->driverVehicleYear?->model?->id,
            "model" => $this?->driverVehicleYear?->model?->name,
            "capacity" => $this?->driverVehicleYear?->model?->capacity,
            "year" => $this?->driverVehicleYear?->year,
            "yearId" => $this?->driverVehicleYear?->id,

            "color" => $this?->driverVehicle?->color,
            "vehicle_form" => $this?->driverVehicle?->getFirstMedia('vehicleForm')?->getUrl(),
            "vehicle_license" => $this?->driverVehicle?->getFirstMedia('vehicleLicense')?->getUrl(),
            "vehicle_ensurance" => $this?->driverVehicle?->getFirstMedia('vehicleEnsurance')?->getUrl(),
            "vehicle_periodic" => $this?->driverVehicle?->getFirstMedia('vehiclePeriodic')?->getUrl(),
            "images" => $this?->driverVehicle?->getMedia("vehicle")->pluck("original_url"),
            "licenseEndDate" => $this?->driverVehicle?->license_end_date,
            "periodicEndDate" => $this?->driverVehicle?->periodic_end_date,
            "ensuranceEndDate" => $this?->driverVehicle?->ensurance_end_date,
            "vehicleNumber" => (string)$this?->driverVehicle?->vehicle_number,
            "vehicleLetter" => $this?->driverVehicle?->vehicle_letter,
            "vehicleSequenceNumber" => (string)$this?->driverVehicle?->sequence_number,
        ];
        return [
            'id' => $this?->id,
            'name' => $this?->name,
            'rate' => $this?->rate,
            'email' => (string)$this?->email,
            'role' => $this?->roles()?->first()?->name,
            "phone" => $this?->phone,
            "iban" => $this?->iban,
            "dateOfBirth" => $this?->date_of_birth,
            "bankName" => $this?->bank_name,
            "bankPersonalId" => $this?->bank_personal_id,

            "phoneVerified" => isset($this->phone_verified_at),
            "emailVerified" => isset($this->email_verified_at),

            "ussidNumber" => $this?->ussid_number,

            'ussid' => $this?->getFirstMedia('ussid')?->getUrl(),
            'avatar' => $this?->getFirstMedia('avatar')?->getUrl(),
            'driverLicense' => $this?->getFirstMedia('driverLicense')?->getUrl(),
            'driverLicenseEndDate' => $this?->driver_license_end_date,
            "vehicle" => $veichel,

            "talebatPrice" => (string)$this->talebat_price,
            "otherPrice" => $this->driverOrg ? (string)$this->driverOrg->other_price : (string)$this->other_price,
            "shouldUpdatePrice" => false,


            "kmPrice" => $this->kmPrice ?? 0,
            "taxPercentage" => $this->taxPercentage ?? 0,
            "subtotal" => $this->subtotal ?? 0, 

            "status" => $this->status,
            "active" => $this->active,
            "tripTotal" => isset($this?->tripTotal) ? (string)number_format($this?->tripTotal,2) : '0',
            "validSeats" => isset($this?->validSeats) ? (string)$this?->validSeats : '0',
            "commentsOnTripsFromClients" => array_filter($this->driverTrips->where('parent_id',0)?->pluck('comment')->toArray()),
        ];
    }
}
