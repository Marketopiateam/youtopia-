<?php

namespace App\Filament\Resources\ApprovalRequests\Schemas;

use App\Enums\ApprovalStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ApprovalRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('workflow.name')
                    ->label('Workflow'),
                TextEntry::make('requestable_type')
                    ->label('Requestable type'),
                TextEntry::make('requestable_id')
                    ->label('Requestable ID'),
                TextEntry::make('requester.employee_code')
                    ->label('Requester'),
                TextEntry::make('current_step')
                    ->numeric(),
                TextEntry::make('status')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ApprovalStatus ? $state->value : (string) $state;

                        return ApprovalStatus::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('submitted_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('completed_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
