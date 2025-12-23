<?php

namespace App\Enums;

enum ReviewStatus: string
{
    case Draft = 'draft';
    case InProgress = 'in_progress';
    case Submitted = 'submitted';
    case Completed = 'completed';

    public function label(): string
    {
        return match($this) {
            self::Draft => 'Draft',
            self::InProgress => 'In Progress',
            self::Submitted => 'Submitted',
            self::Completed => 'Completed',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Draft => 'gray',
            self::InProgress => 'warning',
            self::Submitted => 'info',
            self::Completed => 'success',
        };
    }
}
