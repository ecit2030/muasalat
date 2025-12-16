<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Otp.
 *
 * @mixin \Eloquent
 */
class Otp extends Model
{
    public bool $addToPermission = false;

    protected $guarded = [];

    public function user()
    {
        return User::where('phone', $this->phone)->first();
    }

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            if ($model->code) {
                // TODO: add sms gateway
            }
        });
        static::updated(function ($model) {
            if ($model->code) {
                // TODO: add sms gateway
            }
        });
    }
}
