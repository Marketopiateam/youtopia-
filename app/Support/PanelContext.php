<?php

namespace App\Support;

use Filament\Facades\Filament;
use App\Models\Employee;

class PanelContext
{
    public static function id(): ?string
    {
        return Filament::getCurrentPanel()?->getId();
    }

    public static function is(string $panelId): bool
    {
        return self::id() === $panelId;
    }

    public static function currentEmployeeId(): ?int
    {
        $userId = Filament::auth()->id();
        if (! $userId) return null;

        return Employee::query()->where('user_id', $userId)->value('id');
    }
}
