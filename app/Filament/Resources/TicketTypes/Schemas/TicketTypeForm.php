<?php

namespace App\Filament\Resources\TicketTypes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                Section::make('Ticket Type')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        TextInput::make('code')
                            ->nullable()
                            ->maxLength(50)
                            ->helperText('Optional (مثال: VAC, RESIGN, ADV)'),

                        Toggle::make('is_active')
                            ->default(true)
                            ->inline(false),

                        Section::make('Rules')
                            ->columns(3)
                            ->schema([
                                Toggle::make('needs_dates')
                                    ->default(false)
                                    ->inline(false)
                                    ->helperText('Vacation / Leave Early'),

                                Toggle::make('needs_amount')
                                    ->default(false)
                                    ->inline(false)
                                    ->helperText('Advance / Financial'),

                                Toggle::make('allow_attachments')
                                    ->default(false)
                                    ->inline(false),
                            ])->columnSpanFull(),
                    ]),
            ]);
    }
}
