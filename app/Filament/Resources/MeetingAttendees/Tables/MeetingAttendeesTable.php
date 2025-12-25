<?php

namespace App\Filament\Resources\MeetingAttendees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MeetingAttendeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('meeting.title')
                    ->label('Meeting')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('employee.employee_code')
                    ->label('Employee')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('attendance_status')
                    ->label('Attendance status')
                    ->badge()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('meeting_id')
                    ->label('Meeting')
                    ->relationship('meeting', 'title'),
                SelectFilter::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'employee_code'),
                SelectFilter::make('attendance_status')
                    ->label('Attendance status')
                    ->options([
                        'invited' => 'Invited',
                        'accepted' => 'Accepted',
                        'declined' => 'Declined',
                        'attended' => 'Attended',
                        'absent' => 'Absent',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
