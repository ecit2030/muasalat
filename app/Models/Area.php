<?php

namespace App\Models;

use App\Support\Traits\Filterable;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Area.
 *
 * @mixin \Eloquent
 */
class Area extends Model implements HasMedia
{
    use WithBoot, SlugModel, InteractsWithMedia, HasTranslations, HasFactory, Filterable;

    public bool $addToPermission = true;

    protected $translatable = ['title', 'description'];

    protected $guarded = [];

    protected $with = ['media'];

    public function getFlagAttribute(): string
    {
        return $this->getFirstMediaUrl('flag');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
