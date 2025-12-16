<?php

namespace Modules\Vehicle\Models;

use App\Support\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleBrand extends Model
{
    use SoftDeletes , HasTranslations ;

    public bool $addToPermission = true;

    protected $fillable = [
        'name',
    ];

    protected array $translatable = ['name'];

    public function models()
    {
        return $this->hasMany(VehicleModel::class) ;
    }

}
