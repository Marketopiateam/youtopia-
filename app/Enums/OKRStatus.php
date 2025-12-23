<?php

namespace App\Enums;

enum OKRStatus: string
{
    case Draft = 'draft';
    case Active = 'active';
    case OnTrack = 'on_track';
    case AtRisk = 'at_risk';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match($this) {
            self::Draft => 'Draft',
            self::Active => 'Active',
            self::OnTrack => 'On Track',
            self::AtRisk => 'At Risk',
            self::Completed => 'Completed',
            self::Cancelled => 'Cancelled',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Draft => 'gray',
            self::Active => 'info',
            self::OnTrack => 'success',
            self::AtRisk => 'warning',
            self::Completed => 'success',
            self::Cancelled => 'danger',
        };
    }
}
