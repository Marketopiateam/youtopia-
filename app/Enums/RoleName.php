<?php

namespace App\Enums;

enum RoleName: string
{
    case SUPER_ADMIN = 'super_admin';
    case HR          = 'HR';
    case MANAGER     = 'manager';
    case EMPLOYEE    = 'employee';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::HR          => 'HR',
            self::MANAGER     => 'Manager',
            self::EMPLOYEE    => 'Employee',
        };
    }
}
