<?php

namespace App\Filament\Resources\TicketTypes\Tables;

use App\Models\Ticket;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('code')->toggleable()->sortable(),
            IconColumn::make('is_active')->boolean()->sortable(),
            IconColumn::make('needs_dates')->boolean()->label('Dates'),
            IconColumn::make('needs_amount')->boolean()->label('Amount'),
            IconColumn::make('allow_attachments')->boolean()->label('Attach'),
            TextColumn::make('created_at')->since()->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
