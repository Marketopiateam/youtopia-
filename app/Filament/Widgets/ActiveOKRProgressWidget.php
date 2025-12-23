<?php

namespace App\Filament\Widgets;

use App\Enums\OKRStatus;
use App\Models\OkrObjective;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActiveOKRProgressWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        $activeStatuses = [
            OKRStatus::Active,
            OKRStatus::OnTrack,
            OKRStatus::AtRisk,
        ];

        $activeCount = OkrObjective::query()
            ->whereIn('status', $activeStatuses)
            ->count();

        $average = (float) OkrObjective::query()
            ->whereIn('status', $activeStatuses)
            ->avg('progress_percentage');

        $value = number_format($average, 1) . '%';

        $color = match (true) {
            $average >= 70 => 'success',
            $average >= 40 => 'warning',
            default => 'danger',
        };

        $note = $activeCount > 0
            ? $activeCount . ' active objectives'
            : 'No active objectives';

        return [
            Stat::make('OKR Progress', $value)
                ->description($note)
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color($activeCount > 0 ? $color : 'gray'),
        ];
    }
}
