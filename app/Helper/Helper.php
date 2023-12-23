<?php

function numberCountingFormat($n, $precision = 1)
{
    if ($n < 1000) {
        $format = number_format($n);
    } elseif ($n < 1000000) {
        $format = number_format($n / 1000, $precision) . 'k';
    } elseif ($n < 1000000000) {
        $format = number_format($n / 1000000, $precision) . 'm';
    } else {
        $format = number_format($n / 1000000000, $precision) . 'b';
    }

    return $format;
}