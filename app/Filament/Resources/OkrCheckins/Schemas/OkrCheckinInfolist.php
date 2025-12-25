<?php

namespace App\Filament\Resources\OkrCheckins\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OkrCheckinInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('keyResult.title')
                    ->label('Key result'),
                TextEntry::make('employee.employee_code')
                    ->label('Employee'),
                TextEntry::make('value')
                    ->numeric(),
                TextEntry::make('checked_in_at')
                    ->dateTime(),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
