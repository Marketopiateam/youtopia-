<?php

namespace App\Filament\Widgets;

use App\Enums\InterviewStatus;
use App\Models\Interview;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UpcomingInterviewsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        $start = now();
        $end = now()->addDays(7);

        $upcoming = Interview::query()
            ->whereBetween('scheduled_at', [$start, $end])
            ->whereIn('status', [
                InterviewStatus::Scheduled,
                InterviewStatus::Rescheduled,
                InterviewStatus::InProgress,
            ])
            ->count();

        $nextInterview = Interview::query()
            ->where('scheduled_at', '>=', $start)
            ->whereIn('status', [
                InterviewStatus::Scheduled,
                InterviewStatus::Rescheduled,
                InterviewStatus::InProgress,
            ])
            ->orderBy('scheduled_at')
            ->first();

        $note = $nextInterview
            ? 'Next: ' . $nextInterview->scheduled_at->format('M j, g:i A')
            : 'No upcoming interviews';

        return [
            Stat::make('Upcoming Interviews', $upcoming)
                ->description($note)
                ->descriptionIcon('heroicon-o-calendar-days')
                ->color($upcoming > 0 ? 'info' : 'gray'),
        ];
    }
}
