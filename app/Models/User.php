<?php

namespace App\Models;

use App\Support\Traits\HasPassword;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use App\Traits\Walletable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Vehicle\Models\VehicleYear;
use Modules\Vehicle\Models\UserVehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User.
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, WithBoot, HasPassword, SlugModel, HasFactory, InteractsWithMedia, HasRoles, Notifiable, Walletable;

    public bool $addToPermission = true;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'is_active',
        'is_notifiable',
        'social_id',
        'store_id',
        'rate',

        // driver -- captain
        "date_of_birth",
        "ussid_number",
        "driver_license_number",
        "driver_license_end_date",
        "is_online",

        // driver -- captain -- organization
        'bank_name',
        'bank_personal_id',
        'iban',

        // captain -- organization
        'talebat_price',
        'other_price',
        'update_price',


        // captain
        "status",


        // driver
        "organization_id",


        // oragnization
        "organization_name",
        "organization_commercial_number",
        "address",
        "latitude",
        "longitude",

        // wallet
        "balance",

        "reason",
        "login_count",
        "last_login",

        "phone_verified_at",
        "email_verified_at",
        'wasl_status',
        'wasl_rejections',

        # New Fields
        'username',
        'full_name',
    ];

    public $guard_name = 'dashboard';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['media'];

    protected $casts = [
        'last_login' => 'datetime',

        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'wasl_rejections' => 'json',
    ];


    const moderatorPermissions = ["notification" => ["create", "delete"]];
    const orgPermissions = ["user_withdraw" => ["edit"], "trip" => [], "track" => [], "user_vehicle" => [], "vehicle_request" => ["notification"], "driver" => [], "administration" => [], "role" => [], "permission" => [], "notification" => ["create"]];
    const adminPermissions = ["create_driver", "create_track", "create_user_vehicle", "create_user_withdraw", "vehicle_request" => ["edit"], "create_vehicle_request"];

    // public function getOrganizationNameAttribute()
    // {
    //     return self::find($this?->organization_id)?->organization_name;
    // }
    // public function getOrganizationBalanceAttribute()
    // {
    //     return self::find($this?->organization_id)?->organization_name;
    // }

    public function driverVehicle()
    {
        return $this->hasOne(UserVehicle::class, "driver_id", "id");
    }

    public function tracks()
    {
        return $this->hasMany(Track::class, "owner_id", "id");
    }


    public function captainTrips()
    {
        return $this->hasManyThrough(Trip::class, Track::class, "owner_id", "track_id", "id", "id");
    }

    public function orgTrips()
    {
        return $this->hasManyThrough(Trip::class, Track::class, "owner_id", "track_id", "id", "id");
    }

//    public function driverTrips()
//    {
//        return $this->hasManyThrough(Trip::class, Track::class, "driver_id", "track_id", "id", "id");
//    }

    public function driverTrips(): HasMany
    {
        return $this->hasMany(Trip::class, "driver_id");
    }

    public function driverTripOffers(): HasMany
    {
        return $this->hasMany(DriverTripOffer::class, "driver_id");
    }

    public function driverTracks()
    {
        return $this->hasMany(Track::class, "driver_id");
    }

    public function driverOrg()
    {
        return $this->hasOne(User::class, "id", "organization_id");
    }

    public function captainTracks()
    {
        return $this->hasMany(Track::class, "owner_id");
    }

    public function clientTrips()
    {
        return $this->hasMany(Trip::class, "client_id");
    }

    public function drivers()
    {
        return $this->hasMany(self::class, "organization_id", "id");
    }

    public function withdraws()
    {
        return $this->hasMany(UserWithdraw::class);
    }

    public function vehicles()
    {
        return $this->hasMany(UserVehicle::class, "user_id");
    }

    public function vehicle()
    {
        return $this->hasOne(UserVehicle::class, "user_id");
    }

    public function vehicleYear()
    {
        return $this->hasOneThrough(VehicleYear::class, UserVehicle::class, "user_id", "id", "id", "vehicle_year_id");
    }

    public function driverVehicleYear()
    {
        return $this->hasOneThrough(VehicleYear::class, UserVehicle::class, "driver_id", "id", "id", "vehicle_year_id");
    }

    public function vehicleYears()
    {
        return $this->hasManyThrough(VehicleYear::class, UserVehicle::class, "user_id", "id", "id", "vehicle_year_id");
    }

    public function getAvatarAttribute(): string
    {
        return $this->getFirstMediaUrl('avatar')  ?: asset('storage/default/user-avatar.png');
    }

    public function getActiveAttribute(): string
    {
        return $this->is_active == 1 ? true : false;
    }

    public function getAvatarPhotoAttribute(): string
    {
        return $this->getFirstMediaUrl('avatar');
    }

    public function getLogoPhotoAttribute(): string
    {
        return $this->getFirstMediaUrl('logo');
    }

    public function getVehiclePhotoAttribute(): string
    {
        return $this->getFirstMediaUrl('vehicle');
    }

    public function getFirstMediaUrl(string $collectionName = 'default', string $conversionName = ''): string
    {
        $media = $this->getFirstMedia($collectionName);

        if (!$media) {
            return $this->getFallbackMediaUrl($collectionName) ?: asset('storage/default/user-avatar.png');
        }

        if ($conversionName !== '' && !$media->hasGeneratedConversion($conversionName)) {
            return $media->getUrl();
        }

        return $media->getUrl($conversionName);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function scopeLoggedIn($query)
    {
        return $query->where('id', auth(activeGuard())->id());
    }

    public function info($key = null)
    {
        $relation = $this->hasOne(UserInfo::class, 'user_id', 'id');
        if ($key) {
            $relation = $relation->value($key);
        }

        return $relation;
    }

    public function singleDeviceTokens()
    {
        return $this->hasOne(UserDeviceToken::class, 'user_id', 'id');
    }

    public function deviceTokens()
    {
        return $this->hasMany(UserDeviceToken::class, 'user_id', 'id');
    }

    public function getSendableTokensAttribute()
    {
        return $this->deviceTokens()->select("token")->pluck("token")->toArray();
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }
}
