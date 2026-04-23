<?php

namespace App\Models;

use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\FrequencyTransmission.
 *
 * @mixin \Eloquent
 */
class FrequencyTransmission extends Model
{
        use HasFactory; 

    protected $fillable = [
        'name',
        'driver_id',
        'vehicle_id',
        'map_route_data',
        'origin',
        'destination',
        'repeat',
        'relay_point',
        'specificlocation',
        'date_trans',
        'status_driver',
        'details',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
            'origin' => 'array',
            'destination' => 'array',
            'repeat' => 'array',
            'map_route_data' => 'array',
        ];


    public bool  $addToPermission = True;

    public function driver()
    {
        return $this->belongsTo(User::class, "driver_id", "id");
    }

    public function vehicle()
        {
            return $this->belongsTo(\Modules\Vehicle\Models\UserVehicle::class, 'vehicle_id');
        }


}
