<?php

namespace App\Models;

use App\Casts\UniCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Track.
 *
 * @mixin \Eloquent
 */
class Waypoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "track_id",
        "waypoint",
    ];

    public bool  $addToPermission = false;


    protected $casts = [
        "waypoint"    => UniCode::class,
    ];

    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}
