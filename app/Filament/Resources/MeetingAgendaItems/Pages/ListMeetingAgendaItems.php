<?php

namespace App\Filament\Resources\MeetingAgendaItems\Pages;

use App\Filament\Resources\MeetingAgendaItems\MeetingAgendaItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMeetingAgendaItems extends ListRecords
{
    protected static string $resource = MeetingAgendaItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
