<?php

namespace App\Filament\Resources\Tickets;

use App\Filament\Resources\Tickets\Pages\CreateTicket;
use App\Filament\Resources\Tickets\Pages\EditTicket;
use App\Filament\Resources\Tickets\Pages\ListTickets;
use App\Filament\Resources\Tickets\Pages\ViewTicket;
use App\Filament\Resources\Tickets\Schemas\TicketForm;
use App\Filament\Resources\Tickets\Schemas\TicketInfolist;
use App\Filament\Resources\Tickets\Tables\TicketsTable;
use App\Models\Ticket;
use App\Support\PanelContext;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;


class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Workflows';

    protected static ?string $recordTitleAttribute = 'reason';

    public static function form(Schema $schema): Schema
    {
        return TicketForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'view' => ViewTicket::route('/{record}'),
            'edit' => EditTicket::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->with(['user.employee.profile', 'type']);

        $panel = PanelContext::id();
        $userId = Filament::auth()->id();

        // Employee panel: يشوف تيكتاته بس
        if ($panel === 'employee') {
            return $query->where('user_id', $userId);
        }

        // Manager panel: يشوف تيكتات الموظفين اللي manager_employee_id = employee بتاعه
        if ($panel === 'manager') {
            $managerEmployeeId = PanelContext::currentEmployeeId(); // من user->employee_id
            return $query->whereHas('user.employee', fn($e) => $e->where('manager_employee_id', $managerEmployeeId));
        }

        // HR panel: يشوف كله (أو فلتر pending_hr)
        if ($panel === 'hr') {
            return $query;
        }

        // Admin: كله
        return $query;
    }

    protected static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Filament::auth()->id();
        return $data;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'reason',
            'status',
            'type.name',
            'user.name',
            'user.email',
            'user.employee.profile.first_name',
            'user.employee.profile.last_name',
        ];
    }
}
