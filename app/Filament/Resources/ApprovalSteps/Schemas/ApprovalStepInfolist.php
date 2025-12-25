<?php

namespace App\Filament\Resources\ApprovalSteps\Schemas;

use App\Enums\ApprovalApproverType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ApprovalStepInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('workflow.name')
                    ->label('Workflow'),
                TextEntry::make('step_order')
                    ->numeric(),
                TextEntry::make('approver_type')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ApprovalApproverType ? $state->value : (string) $state;

                        return Str::headline($value);
                    }),
                TextEntry::make('approver_role')
                    ->placeholder('-'),
                TextEntry::make('approver.employee_code')
                    ->label('Approver')
                    ->placeholder('-'),
                TextEntry::make('is_required')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Required' : 'Optional'),
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
