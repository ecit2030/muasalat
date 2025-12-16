<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\DriverTripOffer.
 *
 * @mixin \Eloquent
 */
class DriverTripOffer extends Model
{
        use HasFactory;

    protected $guarded = [];

    public bool  $addToPermission = false;

    public function driver()
    {
        return $this->belongsTo(User::class,'driver_id');
    }


}
