<?php

namespace Modules\Vehicle\Models;

use App\Models\User;
use App\Models\Track;
use App\Support\Traits\HasTranslations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class UserVehicle extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public bool $addToPermission = true;

    protected $fillable = [
        'user_id',
        'vehicle_year_id',

        'sequence_number',
        'vehicle_number',
        "vehicle_letter",

        "color",
        "license_end_date",
        "ensurance_end_date",
        "periodic_end_date",

        'driver_id',
        'is_active',
    ];

    public function getVehicleNameAttribute()
    {
        return $this->year->year  . " - " .
            $this->year->model->getTranslation("name", get_current_lang()) . " - " .
            $this->year->model->brand->getTranslation("name", get_current_lang());
    }

    public function year()
    {
        return $this->belongsTo(VehicleYear::class, "vehicle_year_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class , "user_id" , "id");
    }

    public function driver()
    {
        return $this->belongsTo(User::class, "driver_id","id");
    }

    public function tracks()
    {
        return $this->hasMany(Track::class );
    }


    public function scopeExpiredLisences($query)
    {
        return $query->where('license_end_date', "<" , Carbon::today())
                     ->orWhere('ensurance_end_date', "<" , Carbon::today())
                     ->orWhere('periodic_end_date', "<" , Carbon::today());
    }




}
