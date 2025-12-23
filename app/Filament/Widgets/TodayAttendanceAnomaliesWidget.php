<?php

namespace App\Filament\Widgets;

use App\Enums\AttendanceStatus;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TodayAttendanceAnomaliesWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        [$count, $note] = $this->getAnomalyCountAndNote();

        return [
            Stat::make('Attendance Anomalies', $count)
                ->description($note)
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color($count > 0 ? 'warning' : 'success'),
        ];
    }

    private function getAnomalyCountAndNote(): array
    {
        if (!Schema::hasTable('attendance_logs')) {
            return [0, 'Attendance logs not configured'];
        }

        $query = DB::table('attendance_logs')
            ->whereDate('created_at', today());

        if (Schema::hasColumn('attendance_logs', 'is_anomaly')) {
            return [$query->where('is_anomaly', true)->count(), 'Flagged today'];
        }

        if (Schema::hasColumn('attendance_logs', 'anomaly_type')) {
            return [$query->whereNotNull('anomaly_type')->count(), 'Flagged today'];
        }

        $statusColumn = Schema::hasColumn('attendance_logs', 'status')
            ? 'status'
            : (Schema::hasColumn('attendance_logs', 'attendance_status') ? 'attendance_status' : null);

        if ($statusColumn) {
            return [
                $query->whereIn($statusColumn, [
                    AttendanceStatus::Absent->value,
                    AttendanceStatus::Late->value,
                    AttendanceStatus::HalfDay->value,
                ])->count(),
                'Late or absent today',
            ];
        }

        return [0, 'No anomaly fields configured'];
    }
}
