<?php

namespace App\Filament\Resources\VoteOptions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VoteOptionForm
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
                TextInput::make('option_text')
                    ->required()
                    ->maxLength(255),
                TextInput::make('order')
                    ->numeric()
                    ->required()
                    ->default(0),
            ]);
    }
}
