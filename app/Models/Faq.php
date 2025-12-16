<?php

namespace App\Models;

use App\Support\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\StudentQuestion.
 *
 * @mixin \Eloquent
 */
class Faq extends Model
{
        use HasFactory ,HasTranslations;

    protected $fillable = [
        "question" ,
        "answer" ,
    ];

    public bool  $addToPermission = True;

    protected $translatable = ["question" , "answer"];


}
