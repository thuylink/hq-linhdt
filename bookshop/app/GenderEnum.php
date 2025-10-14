<?php

namespace App;

enum GenderEnum: int
{
    case MALE = 1;
    case FEMALE = 2;
    case OTHER = 3;

    public function label(): string
    {
        return match ($this) {
            self::MALE => 'Male',
            self::FEMALE => 'Feamle',
            self::OTHER => 'Other'
        };
    }
}
