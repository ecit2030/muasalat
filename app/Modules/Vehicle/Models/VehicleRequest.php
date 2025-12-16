<?php

namespace Modules\Vehicle\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class VehicleRequest extends Model
{

    public bool $addToPermission = true;

    protected $fillable = [
        'user_id',
        'content',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class , "user_id") ;
    }}
