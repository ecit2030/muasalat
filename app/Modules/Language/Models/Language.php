<?php

namespace Modules\Language\Models;

use App\Support\Traits\WithBoot;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use WithBoot;

    public bool $addToPermission = false;

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
