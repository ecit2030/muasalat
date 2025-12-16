<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\Traits\SlugModel;
use App\Support\Traits\WithBoot;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Chat.
 *
 * @mixin \Eloquent
 */
class Chat extends Model
{

    use HasFactory;

    protected $fillable = [
        "sender_id",
        "receiver_id",
        "trip_id",
    ];

    public bool  $addToPermission = false;

    public function sender()
    {
        return $this->belongsTo(User::class , "sender_id" ,"id");
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
    public function receiver()
    {
        return $this->belongsTo(User::class , "receiver_id" ,"id");
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class , "chat_id","id");
    }

}

