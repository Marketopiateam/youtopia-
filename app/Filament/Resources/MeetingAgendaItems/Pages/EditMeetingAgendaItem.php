<?php

namespace App\Filament\Resources\MeetingAgendaItems\Pages;

use App\Filament\Resources\MeetingAgendaItems\MeetingAgendaItemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMeetingAgendaItem extends EditRecord
{
    protected static string $resource = MeetingAgendaItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
