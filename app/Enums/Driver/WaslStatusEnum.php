<?php

namespace App\Enums\Driver;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self valid() // valid at wasl
 * @method static self invalid() // invalid at wasl
 * @method static self pending() // waiting for wasl confirmation
 * @method static self failed() // failed to register info at wasl
 */
class WaslStatusEnum extends Enum
{
}
