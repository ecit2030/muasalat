<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\UserWithdraw.
 *
 * @mixin \Eloquent
 */
class UserWithdraw extends Model
{
        use HasFactory;

    protected $fillable = [
        "user_id" ,
        "balance" ,
        "status",
        "reason",
        "admin_date"
    ];

    public bool  $addToPermission = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
