<?php
namespace App\Converters;

use App\Interfaces\NumberConverterInterface;

class AlphaConverter implements NumberConverterInterface
{
    public function convert($number)
    {
        $letters = '';
        $positiveNumber = abs($number);
        while ($positiveNumber > 0) {
            if ($positiveNumber % 26 == 0) {
                $code = 26;
            } else {
                $code = $positiveNumber % 26;
            }

            $letters .= chr($code + 64);
            $positiveNumber = ($positiveNumber - $code) / 26;
        }
        if ($number < 0) {
            $letters .= '-';
        }
        return strtoupper(strrev($letters));
    }
}
