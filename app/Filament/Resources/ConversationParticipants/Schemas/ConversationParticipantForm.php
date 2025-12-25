<?php

namespace App\Filament\Resources\ConversationParticipants\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ConversationParticipantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('conversation_id')
                    ->label('Conversation')
                    ->relationship('conversation', 'id')
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
