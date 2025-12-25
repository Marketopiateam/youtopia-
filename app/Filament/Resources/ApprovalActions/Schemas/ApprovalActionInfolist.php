<?php

namespace App\Filament\Resources\ApprovalActions\Schemas;

use App\Enums\ApprovalActionType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ApprovalActionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('approvalRequest.id')
                    ->label('Request'),
                TextEntry::make('step.step_order')
                    ->label('Step'),
                TextEntry::make('approver.employee_code')
                    ->label('Approver'),
                TextEntry::make('action')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ApprovalActionType ? $state->value : (string) $state;

                        return Str::headline($value);
                    }),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('acted_at')
                    ->dateTime(),
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
