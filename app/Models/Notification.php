<?php

namespace App\Models;

use App\Casts\UniCode;
use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * App\Models\Notification.
 *
 * @mixin \Eloquent
 */
class Notification extends Model
{
        use HasFactory;

    protected $table = "notifications";
    public $incrementing = false;

    protected $casts = [
        "data" => UniCode::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class , "notifiable_id" , "id" );
    }


    public function notifiable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, "notifiable_type", "notifiable_id");
    }

    public bool  $addToPermission = false;


}
