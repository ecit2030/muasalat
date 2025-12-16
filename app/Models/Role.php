<?php

namespace App\Models;

use Modules\UserActivity\App\Traits\Loggable;
use  Spatie\Permission\Models\Role as SpatieRole;

/**
 * App\Models\Area.
 *
 * @mixin \Eloquent
 */
class Role extends SpatieRole
{
    use Loggable;
    public bool $addToPermission = true;
}
