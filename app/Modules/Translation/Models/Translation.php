<?php

namespace Modules\Translation\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    public bool $addToPermission = false;
    protected $guarded = [];

    protected $casts = ['t_' => 'array'];
}
