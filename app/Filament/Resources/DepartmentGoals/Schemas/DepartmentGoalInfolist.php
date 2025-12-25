<?php

namespace App\Filament\Resources\DepartmentGoals\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DepartmentGoalInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('department.name')
                    ->label('Department'),
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('quarter')
                    ->numeric(),
                TextEntry::make('year')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('owner.employee_code')
                    ->label('Owner'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
