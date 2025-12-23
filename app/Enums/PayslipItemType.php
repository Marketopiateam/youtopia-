<?php

namespace App\Enums;

enum PayslipItemType: string
{
    case Earning = 'earning';
    case Deduction = 'deduction';

    public function label(): string
    {
        return match($this) {
            self::Earning => 'Earning',
            self::Deduction => 'Deduction',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Earning => 'success',
            self::Deduction => 'danger',
        };
    }
}
