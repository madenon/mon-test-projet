<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self NO_EXPERIENCE()
 * @method static self LESS_THAN_5_YEARS()
 * @method static self BETWEEN_5_AND_10_YEARS()
 * @method static self BETWEEN_10_AND_25_YEARS()
 * @method static self MORE_THAN_25_YEARS()
 */
class ExperienceLevel extends Enum
{
    protected static function values(): array
    {
        return [
            'NO_EXPERIENCE' => 'Sans expérience',
            'LESS_THAN_5_YEARS' => '-5 ans',
            'BETWEEN_5_AND_10_YEARS' => '+5 à 10 ans',
            'BETWEEN_10_AND_25_YEARS' => '+10 à 25 ans',
            'MORE_THAN_25_YEARS' => '+25 ans',
        ];
    }
}
