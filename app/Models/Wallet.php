<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Wallet.
 *
 * @mixin \Eloquent
 */
class Wallet extends Model
{
        use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];
    protected $fillable = [
        'type', 'transaction_reasons', 'transaction_type',
        'current', 'steps', 'balance', 'data'];


    public bool  $addToPermission = false;

    # Relations
    public function wallettable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'wallettable_id', 'id');
    }


}
