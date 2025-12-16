<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Transaction.
 *
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
        'pay_data' => 'array',
        'pay_at' => 'timestamp',
    ];

    # Relations
    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }



}
