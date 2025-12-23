<?php

namespace App\Enums;

enum PayrollCycleStatus: string
{
    case Draft = 'draft';
    case Processing = 'processing';
    case Processed = 'processed';
    case Approved = 'approved';
    case Paid = 'paid';

    public function label(): string
    {
        return match($this) {
            self::Draft => 'Draft',
            self::Processing => 'Processing',
            self::Processed => 'Processed',
            self::Approved => 'Approved',
            self::Paid => 'Paid',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Draft => 'gray',
            self::Processing => 'warning',
            self::Processed => 'info',
            self::Approved => 'primary',
            self::Paid => 'success',
        };
    }
}
