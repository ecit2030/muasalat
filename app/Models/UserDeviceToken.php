<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDeviceToken extends Model
{
    public bool $addToPermission = false;

    protected $fillable = ['token'];
}
