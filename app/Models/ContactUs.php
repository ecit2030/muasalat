<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "phone",
        "is_replied",
        "reply",
        "message",
    ];

    protected  $casts = [
        'is_replied' => 'boolean',
    ];
    public bool  $addToPermission = true;

}
