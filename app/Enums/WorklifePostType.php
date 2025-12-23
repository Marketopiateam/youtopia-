<?php

namespace App\Enums;

enum WorklifePostType: string
{
    case General = 'general';
    case Announcement = 'announcement';
    case Achievement = 'achievement';
    case Auto = 'auto';

    public function label(): string
    {
        return match($this) {
            self::General => 'General',
            self::Announcement => 'Announcement',
            self::Achievement => 'Achievement',
            self::Auto => 'Auto Generated',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::General => 'gray',
            self::Announcement => 'info',
            self::Achievement => 'success',
            self::Auto => 'warning',
        };
    }
}
