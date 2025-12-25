<?php

namespace App\Filament\Resources\MeetingAgendaItems\Pages;

use App\Filament\Resources\MeetingAgendaItems\MeetingAgendaItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMeetingAgendaItem extends CreateRecord
{
    protected static string $resource = MeetingAgendaItemResource::class;
}
