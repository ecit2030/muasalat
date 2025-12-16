<?php

namespace App\Models;

use App\Support\Traits\SlugModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Currency.
 *
 * @mixin \Eloquent
 */
class Currency extends Model
{
    use  SlugModel, HasTranslations, SoftDeletes;

    public bool $addToPermission = false;

    protected $translatable = ['title'];

    protected $fillable = [
        'title',
        'code',
        'symbol',
        'exchange_rate',
        'auto_update_rate',
        'active',
        'default',
    ];

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public static function getDefaultCurrency()
    {
        return self::whereDefault('default', true)->first();
    }
}
