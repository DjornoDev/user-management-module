<?php

namespace App\Enums;

enum ExtensionName: string
{
    case Jr = 'Jr';
    case Sr = 'Sr';
    case II = 'II';
    case III = 'III';
    case IV = 'IV';
    case V = 'V';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
