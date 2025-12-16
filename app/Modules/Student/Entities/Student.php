<?php

namespace Modules\Student\Entities;

use App\Traits\Fcmable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Fcmable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_active'
    ];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    public function getEmailAttribute($value): string
    {
        return strtolower($value);
    }
    //relations

    public function routeNotificationForFcm($notifiable)
    {
        return $this->fcm_token;
    }

}
