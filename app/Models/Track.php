<?php

namespace App\Models;

use App\Casts\UniCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Vehicle\Models\UserVehicle;

/**
 * App\Models\Track.
 *
 * @mixin \Eloquent
 */
class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "driver_id",
        "owner_id",
        "user_vehicle_id",
        "is_active",
        "origin",
        "destination",
        "repeat",
        "map_route_data",
    ];

    public bool  $addToPermission = true;

    protected $hidden = ["map_route_data"];

    protected $casts = [
        "origin"       => UniCode::class,
        "destination"  => UniCode::class,
        "repeat"       =>  "array",
        "map_route_data"   =>  "array"
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, "owner_id");
    }

    public function ScopeWithoutRoute($query)
    {
        return $query->select("id", "name", "driver_id", "owner_id", "user_vehicle_id", "is_active", "origin", "destination", "repeat",);
    }

    public function waypoints()
    {
        return $this->hasMany(Waypoint::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(UserVehicle::class, "user_vehicle_id", "id");
    }

    public function getVehicleNameAttribute()
    {
        return $this->vehicle->year->year  . " - " .
            $this->vehicle->year->model->getTranslation("name", get_current_lang()) . " - " .
            $this->vehicle->year->model->brand->getTranslation("name", get_current_lang());
    }


    public function driver()
    {
        return $this->belongsTo(User::class, "driver_id" , "id");
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
