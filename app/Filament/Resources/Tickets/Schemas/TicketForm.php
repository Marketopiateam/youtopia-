<?php

namespace App\Filament\Resources\Tickets\Schemas;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\TicketType;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Ticket')
                ->columns(2)
                ->schema([
                    Select::make('ticket_type_id')
                        ->label('Ticket Type')
                        ->options(
                            fn() => TicketType::query()
                                ->where('is_active', true)
                                ->orderBy('name')
                                ->pluck('name', 'id')
                                ->toArray()
                        )
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live(), // 👈 مهم عشان الفورم يحدّث نفسه

                    Select::make('priority')
                        ->options([
                            TicketPriority::Low->value => 'Low',
                            TicketPriority::Medium->value => 'Medium',
                            TicketPriority::High->value => 'High',
                        ])
                        ->default(TicketPriority::Medium->value)
                        ->required(),

                    Textarea::make('reason')
                        ->columnSpanFull()
                        ->required()
                        ->rows(4),

                    // Dates (dynamic)
                    DatePicker::make('expected_from')
                        ->label('Expected From')
                        ->visible(fn($get) => self::typeNeedsDates($get('ticket_type_id')))
                        ->required(fn($get) => self::typeNeedsDates($get('ticket_type_id'))),

                    DatePicker::make('expected_to')
                        ->label('Expected To')
                        ->visible(fn($get) => self::typeNeedsDates($get('ticket_type_id')))
                        ->required(fn($get) => self::typeNeedsDates($get('ticket_type_id'))),

                    // Amount (dynamic)
                    TextInput::make('amount')
                        ->numeric()
                        ->step('0.01')
                        ->visible(fn($get) => self::typeNeedsAmount($get('ticket_type_id')))
                        ->required(fn($get) => self::typeNeedsAmount($get('ticket_type_id'))),

                    // Attachments (dynamic)
                    FileUpload::make('attachments')
                        ->label('Attachments')
                        ->disk('public')
                        ->directory('tickets/attachments')
                        ->multiple()
                        ->openable()
                        ->downloadable()
                        ->preserveFilenames()
                        ->visible(fn($get) => self::typeAllowsAttachments($get('ticket_type_id'))),
                ]),
        ]);
    }

    protected static function typeNeedsDates($ticketTypeId): bool
    {
        if (! $ticketTypeId) return false;
        return (bool) TicketType::query()->whereKey($ticketTypeId)->value('needs_dates');
    }

    protected static function typeNeedsAmount($ticketTypeId): bool
    {
        if (! $ticketTypeId) return false;
        return (bool) TicketType::query()->whereKey($ticketTypeId)->value('needs_amount');
    }

    protected static function typeAllowsAttachments($ticketTypeId): bool
    {
        if (! $ticketTypeId) return false;
        return (bool) TicketType::query()->whereKey($ticketTypeId)->value('allow_attachments');
    }
}
