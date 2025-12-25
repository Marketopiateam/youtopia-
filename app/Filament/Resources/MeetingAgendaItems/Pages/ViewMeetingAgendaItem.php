<?php

namespace App\Filament\Resources\MeetingAgendaItems\Pages;

use App\Filament\Resources\MeetingAgendaItems\MeetingAgendaItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMeetingAgendaItem extends ViewRecord
{
    protected static string $resource = MeetingAgendaItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
