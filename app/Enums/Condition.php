<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self NEW()
 * @method static self VERY_GOOD()
 * @method static self GOOD()
 * @method static self MEDIUM()
 * @method static self BAD()
 * @method static self BROKEN()
 */
class Condition extends Enum
{
    protected static function values(): array
    {
        return [
            'NEW' => 'Neuf',
            'VERY_GOOD' => 'Très bon état',
            'GOOD' => 'Bon état',
            'MEDIUM' => 'Etat moyen',
            'BAD' => 'Mauvais état',
            'BROKEN' => 'En panne',
        ];
    }
}
