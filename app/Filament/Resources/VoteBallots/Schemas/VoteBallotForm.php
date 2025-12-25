<?php

namespace App\Filament\Resources\VoteBallots\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class VoteBallotForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vote_id')
                    ->label('Vote')
                    ->relationship('vote', 'title')
                    ->searchable()
                    ->required(),
                Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('option_id')
                    ->label('Option')
                    ->relationship('option', 'option_text')
                    ->searchable()
                    ->required(),
                DateTimePicker::make('voted_at')
                    ->required(),
            ]);
    }
}
