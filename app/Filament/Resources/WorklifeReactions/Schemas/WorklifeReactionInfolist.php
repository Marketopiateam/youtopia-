<?php

namespace App\Filament\Resources\WorklifeReactions\Schemas;

use App\Enums\ReactionType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WorklifeReactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('reactable_type')
                    ->label('Reactable type'),
                TextEntry::make('reactable_id')
                    ->label('Reactable ID'),
                TextEntry::make('employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('reaction_type')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ReactionType ? $state->value : (string) $state;

                        return ReactionType::tryFrom($value)?->name ?? $value;
                    }),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
