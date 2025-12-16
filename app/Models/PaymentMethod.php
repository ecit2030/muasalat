<?php

namespace App\Models;

use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\PaymentMethod.
 *
 * @mixin \Eloquent
 */
class PaymentMethod extends Model
{
    use WithBoot, SlugModel, HasTranslations;
    public bool $addToPermission = false;

    protected $guarded = [];
    protected $fillable = ['title', 'description', 'code', 'active', 'data'];
    protected $translatable = ['title', 'description'];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
