<?php
namespace App\Converters;

use App\Interfaces\NumberConverterInterface;

class KooreanConverter implements NumberConverterInterface
{
    public function convert($number)
    {
        return '#';
    }
}
