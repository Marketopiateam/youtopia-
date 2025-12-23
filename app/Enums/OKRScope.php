<?php

namespace App\Enums;

enum OKRScope: string
{
    case Company = 'company';
    case Department = 'department';
    case Employee = 'employee';

    public function label(): string
    {
        return match($this) {
            self::Company => 'Company',
            self::Department => 'Department',
            self::Employee => 'Employee',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Company => 'success',
            self::Department => 'primary',
            self::Employee => 'info',
        };
    }
}
