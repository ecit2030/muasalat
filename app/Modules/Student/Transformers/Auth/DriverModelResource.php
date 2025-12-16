<?php

namespace Modules\Student\Transformers\Auth;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverModelResource extends JsonResource
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
            'avatar' => $this->getFirstMediaUrl('avatar'),
            "phoneVerified" => isset($this->phone_verified_at),
            "emailVerified" => isset($this->email_verified_at),
            'driverLicenseEndDate' => $this?->driver_license_end_date,
            'role' => $this?->roles()?->first()?->name,
            "phone" => $this?->phone,
            "status" => $this->status,
            "active" => $this->active,
            "canAddTrack" => false,
            "shouldUpdatePrice" => $this->update_price ? true : false,
        ];
    }
}
