<?php

function toDotFormat($array)
{
    $array = explode('[', $array);
    $array = array_map(function ($item) {
        return str_replace(']', '', $item);
    }, $array);

    return implode('.', $array);
}

function render_rate_stars($rate)
{
    $minus = 5 - $rate;
    $one = '<a href="javascript:void(0);"><i class="fa fa-star text-warning"></i></a>';
    $half = '<a href="javascript:void(0);"><i class="fa fa-star-o text-warning me-1"></i></a>';
    $all = '';

    for ($i = 1; $i <= $rate; $i++) {
        $all .= $one;
    }

    for ($i = 1; $i <= $minus; $i++) {
        $all .= $half;
    }

    return $all;
}