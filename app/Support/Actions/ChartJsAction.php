<?php

namespace App\Support\Actions;

use Support\ChartJs\ChartJsBuilder;

class ChartJsAction extends ChartJsBuilder
{
    public static function new($name): self
    {
        $chart = new self();

        return $chart->name($name);
    }
}
