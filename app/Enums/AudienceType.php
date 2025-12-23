<?php

namespace App\Enums;

enum AudienceType: string
{
    case Company = 'company';
    case Department = 'department';
    case Team = 'team';
    case Role = 'role';
    case Custom = 'custom';

    public function label(): string
    {
        return match($this) {
            self::Company => 'Company Wide',
            self::Department => 'Department',
            self::Team => 'Team',
            self::Role => 'Role',
            self::Custom => 'Custom',
        };
    }
}
