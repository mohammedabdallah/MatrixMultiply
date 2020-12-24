<?php 
namespace App\Helpers;

class LoadClass 
{
    public static function load($className)
    {
        return '\\App\\Converters\\'.str_replace(
            ' ',
            '',
            ucwords(str_replace('_', ' ', $className))
        ).'Converter';
    }
}