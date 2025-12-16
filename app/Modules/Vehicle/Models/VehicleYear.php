<?php

namespace Modules\Vehicle\Models;

use App\Support\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleYear extends Model
{
    use SoftDeletes ;

    public bool $addToPermission = true;

    protected $fillable = [
        'vehicle_model_id',
        'year',
    ];

    public function model()
    {
        return $this->belongsTo(VehicleModel::class ,"vehicle_model_id" , "id") ;
    }
}
