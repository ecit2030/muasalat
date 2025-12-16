<?php

namespace Modules\Vehicle\Models;

use App\Support\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{
    use SoftDeletes , HasTranslations ;

    public bool $addToPermission = true;

    protected $fillable = [
        'vehicle_brand_id',
        'name',
        'capacity',
    ];

    protected array $translatable = ['name'];


    public function years()
    {
        return $this->hasMany(VehicleYear::class) ;
    }

    public function brand()
    {
        return $this->belongsTo(VehicleBrand::class ,"vehicle_brand_id") ;
    }

    public function getNameCapacityAttribute()
    {
        return $this->name ." ( ".  t_("capacity is") ." ". $this->capacity ." )" ;
    }


}
