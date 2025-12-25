<?php

namespace App\Filament\Resources\WorklifeLikes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class WorklifeLikeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('post_id')
                    ->label('Post')
                    ->relationship('post', 'id')
                    ->searchable()
                    ->required(),
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
            ]);
    }
}
