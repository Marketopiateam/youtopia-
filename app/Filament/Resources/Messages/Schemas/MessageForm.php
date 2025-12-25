<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MessageForm
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
                Select::make('sender_employee_id')
                    ->label('Sender')
                    ->relationship('sender', 'employee_code')
                    ->searchable()
                    ->required(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
