<?php

namespace App\Util;

class NumberUtil
{
    public static function shortNumber($number)
    {
        $abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => ''];

        foreach ($abbrevs as $exponent => $abbrev) {
            if (abs($number) >= pow(10, $exponent)) {
                $display = $number / pow(10, $exponent);
                $decimals = ($exponent >= 3 && round($display) < 100) ? 1 : 0;

                $number = number_format($display, $decimals).$abbrev;

                break;
            }
        }

        return $number;
    }
}
