<?php

namespace App\Filament\Resources\Tickets\Pages;

use App\Filament\Resources\Tickets\TicketResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Enums\TicketStatus;
use Filament\Schemas\Components\Tabs\Tab;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),


            TicketStatus::PendingManager->value => Tab::make('Pending Manager')
                ->modifyQueryUsing(fn($query) => $query->where('status', TicketStatus::PendingManager)),

            TicketStatus::PendingHr->value => Tab::make('Pending HR')
                ->modifyQueryUsing(fn($query) => $query->where('status', TicketStatus::PendingHr)),

            TicketStatus::Approved->value => Tab::make('Approved')
                ->modifyQueryUsing(fn($query) => $query->where('status', TicketStatus::Approved)),

            TicketStatus::Rejected->value => Tab::make('Rejected')
                ->modifyQueryUsing(fn($query) => $query->where('status', TicketStatus::Rejected)),
        ];
    }
}
