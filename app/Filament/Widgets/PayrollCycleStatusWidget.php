<?php

namespace App\Filament\Widgets;

use App\Models\PayrollCycle;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PayrollCycleStatusWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        $today = today();

        $cycle = PayrollCycle::query()
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->orderByDesc('start_date')
            ->first();

        if (!$cycle) {
            $cycle = PayrollCycle::query()
                ->orderByDesc('start_date')
                ->first();
        }

        $status = $cycle?->status?->label() ?? 'No cycle';
        $color = $cycle?->status?->color() ?? 'gray';

        $period = $cycle
            ? $cycle->start_date->format('M j') . ' - ' . $cycle->end_date->format('M j')
            : 'Not scheduled';

        return [
            Stat::make('Payroll Status', $status)
                ->description($period)
                ->descriptionIcon('heroicon-o-banknotes')
                ->color($color),
        ];
    }
}
