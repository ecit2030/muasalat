<?php

namespace App\Models;

use Modules\UserActivity\App\Traits\Loggable;
use  Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * App\Models\Area.
 *
 * @mixin \Eloquent
 */
class Permission extends SpatiePermission
{
    use Loggable;

    public bool $addToPermission = false;
}
