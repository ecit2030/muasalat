<?php

namespace App\Support\Traits;

use ReflectionClass;

trait EnumToArray
{
    public static function toArray()
    {
        $enum = new ReflectionClass(self::class);
        return $enum->getConstants();
    }
}
