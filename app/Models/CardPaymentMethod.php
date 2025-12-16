<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\CardPaymentMethod.
 *
 * @mixin \Eloquent
 */
class CardPaymentMethod extends Model
{
        use HasFactory;

    protected $guarded = [];

    public bool  $addToPermission = false;


}
