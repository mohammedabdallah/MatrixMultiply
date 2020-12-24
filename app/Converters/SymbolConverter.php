<?php
namespace App\Converters;

use App\Interfaces\NumberConverterInterface;

class SymbolConverter implements NumberConverterInterface
{
    public function convert($number)
    {
        return '@';
    }
}
