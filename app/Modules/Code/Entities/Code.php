<?php

namespace Modules\Code\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function codeable()
    {
        return $this->morphTo();
    }
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    public function getEmailAttribute($value)
    {
        return strtolower($value);
    }
}
