<?php

namespace App\Filament\Resources\LeaveRequests\Schemas;

use App\Enums\LeaveStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LeaveRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('employee.employee_code')
                    ->label('Employee'),
                TextEntry::make('leaveType.name')
                    ->label('Leave type'),
                TextEntry::make('from_date')
                    ->date(),
                TextEntry::make('to_date')
                    ->date(),
                TextEntry::make('days_count')
                    ->numeric(),
                TextEntry::make('status')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof LeaveStatus ? $state->value : (string) $state;

                        return LeaveStatus::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('reason')
                    ->columnSpanFull(),
                TextEntry::make('submitted_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
