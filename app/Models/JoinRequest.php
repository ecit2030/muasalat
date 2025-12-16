<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Modules\Vehicle\Models\VehicleYear;
use Modules\Vehicle\Models\UserVehicle;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\OrganizationRequestModel.
 *
 * @mixin \Eloquent
 */
class JoinRequest extends Model implements HasMedia
{
    use InteractsWithMedia;

    public bool $addToPermission = false;

    protected $fillable = [
        "name",
        "phone",
        "email",

        "organization_name",
        "organization_commercial_number",

        "address",
        "latitude",
        "longitude",

        "bank_name",
        "bank_personal_id",
        "iban",

    ];

    public function getAvatarAttribute(): string
    {
        return $this->getFirstMediaUrl('avatar')  ?: asset('storage/default/user-avatar.png');
    }

}
