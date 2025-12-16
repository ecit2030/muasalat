<?php

namespace App\Support\Datatables\Columns;

class StatusColumn
{
    public static function render($color, $value): string
    {
        return "<span class='badge badge-{$color}'>{$value}</span>";
    }
}
