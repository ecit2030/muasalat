<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Setting.
 *
 * @mixin \Eloquent
 */
class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;

    public bool $addToPermission = true;

    protected $guarded = [];

    protected $casts = [
        'value' => 'array',
    ];

    public function referenceable()
    {
        return $this->morphTo(__FUNCTION__, 'reference_type', 'reference_id');
    }
}
