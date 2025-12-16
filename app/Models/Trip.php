<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Trip.
 *
 * @mixin \Eloquent
 */
class Trip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'report_id',
        'track_id',
        'driver_id',
        'client_id',
        'date',
        'rate',
        'comment',
        "origin",
        "destination",
        "start_at",
        "end_at",
        "time",
        "is_canceled",
        "cancel_reason",
        "trip_type",
        "parent_id",
        "is_delivered_to_client",
    ];

    public bool $addToPermission = true;


    protected $casts = [
        "origin" => "array",
        "destination" => "array",
    ];

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, "client_id", "id");
    }
    public function driver()
    {
        return $this->belongsTo(User::class, "driver_id", "id");
    }

    public function chat()
    {
        return $this->hasOne(Chat::class,'trip_id');
    }

    public function owner()
    {
        return $this->hasOneThrough(User::class, Track::class, "owner_id", "id");
    }

    public function driverTripOffers(): HasMany
    {
        return $this->hasMany(DriverTripOffer::class, "trip_id");
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, "parent_id");
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, "parent_id");
    }


}
