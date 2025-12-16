<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\ChatMessage.
 *
 * @mixin \Eloquent
 */
class ChatMessage extends Model
{
        use HasFactory;

        protected $fillable = [
            "chat_id",
            "message",
            "read_at",
            "user_id"
        ];

    public bool  $addToPermission = false;

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }


}
