<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Language\Models\Language;

/**
 * App\Models\UserInfo.
 *
 * @mixin \Eloquent
 */
class UserInfo extends Model
{
    public bool $addToPermission = false;

    protected $guarded = [];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_code', 'code');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }
}
