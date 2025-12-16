<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Module.
 *
 * * @mixin \Eloquent
 */
class Module extends Model
{
    public bool $addToPermission = false;

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'module_id', 'id');
    }
}
