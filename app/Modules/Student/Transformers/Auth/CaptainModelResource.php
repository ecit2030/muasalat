<?php

namespace Modules\Student\Transformers\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Vehicle\Http\Resources\VehicleImagesResource;

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
        return [
            'id' => $this?->id,
            'name' => $this?->name,
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
            "latitude" => $this?->latitude,
            "longitude" => $this?->longitude,

            'ussid' => $this?->getFirstMedia('ussid')?->getUrl(),
            'avatar' => $this?->getFirstMedia('avatar')?->getUrl(),
            'driverLicense' => $this?->getFirstMedia('driverLicense')?->getUrl(),
            'driverLicenseEndDate' => $this?->driver_license_end_date,

            "talebatPrice" => (string)$this->talebat_price,
            "otherPrice" => (string)$this->other_price,
            "canAddTrack" => is_null($this->talebat_price) || is_null($this->talebat_price) ? false : true,
            "shouldUpdatePrice" => false,

            "status" => $this->status,
            "active" => $this->active,
            "is_online" => $this->is_online,
            "InOrganization" => $this?->driverOrg()->exists(),

            "vehicle" => [

                "brandId" => $this?->vehicleYear?->model?->brand?->id,
                "brand" => $this?->vehicleYear?->model?->brand?->name,
                "modelId" => $this?->vehicleYear?->model?->id,
                "model" => $this?->vehicleYear?->model?->name,
                "capacity" => $this?->vehicleYear?->model?->capacity,
                "year" => $this?->vehicleYear?->year,
                "yearId" => $this?->vehicleYear?->id,

                "color" => $this?->vehicle?->color,
                "vehicle_form" => $this?->vehicle?->getFirstMedia('vehicleForm')?->getUrl(),
                "vehicle_license" => $this?->vehicle?->getFirstMedia('vehicleLicense')?->getUrl(),
                "vehicle_ensurance" => $this?->vehicle?->getFirstMedia('vehicleEnsurance')?->getUrl(),
                "vehicle_periodic" => $this?->vehicle?->getFirstMedia('vehiclePeriodic')?->getUrl(),
                "images" => $this?->vehicle?->getMedia("vehicle")->pluck("original_url"),
                "licenseEndDate" => $this?->vehicle?->license_end_date,
                "periodicEndDate" => $this?->vehicle?->periodic_end_date,
                "ensuranceEndDate" => $this?->vehicle?->ensurance_end_date,
                "vehicleNumber" => (string)$this?->vehicle?->vehicle_number,
                "vehicleLetter" => $this?->vehicle?->vehicle_letter,
                "vehicleSequenceNumber" => (string)$this?->vehicle?->sequence_number,
            ]
        ];
    }
}
