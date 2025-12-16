<?php

namespace Modules\Analyse\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Area.
 *
 * @mixin \Eloquent
 */
class Analyse extends Model
{

    public bool $addToPermission = true;
    protected $fillable = ['type', 'diff', 'done', 'status', 'title', 'insightClass', 'file', 'line', 'message', 'data'];

    protected $casts = ['data' => 'array'];
}
