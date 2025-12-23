<?php

namespace App\Enums;

enum GoalType: string
{
    case Company = 'company';
    case Department = 'department';

    public function label(): string
    {
        return match($this) {
            self::Company => 'Company Goal',
            self::Department => 'Department Goal',
        };
    }
}
