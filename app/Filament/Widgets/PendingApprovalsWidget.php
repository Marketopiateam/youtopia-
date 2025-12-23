<?php

namespace App\Filament\Widgets;

use App\Enums\ApprovalStatus;
use App\Models\ApprovalRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PendingApprovalsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        $user = auth()->user();
        $employeeId = $user?->employee?->id;

        $pending = ApprovalRequest::where('status', ApprovalStatus::Pending)
            ->whereHas('workflow.steps', function ($query) use ($employeeId) {
                $query->where('approver_employee_id', $employeeId);
            })
            ->count();

        return [
            Stat::make('Pending Approvals', $pending)
                ->description('Awaiting your action')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
        ];
    }
}
