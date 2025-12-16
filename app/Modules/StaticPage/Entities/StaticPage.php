<?php

namespace Modules\StaticPage\Entities;

use App\Casts\UniCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class StaticPage extends Model
{
    use HasFactory ,HasTranslations;

    public const ABOUT = 'ABOUT_US';

    public const TERMS = 'TERMS_AND_CONDITIONS';

    public const PRIVACY = 'PRIVACY_AND_POLICIES';

    public bool $addToPermission = true;

    public $timestamps = false;

    protected $fillable = ['title', 'content'];

    protected $translatable = ["title"];

    protected $casts = [
        "content"       => UniCode::class,
    ];

    protected $keyType = 'string';

}
