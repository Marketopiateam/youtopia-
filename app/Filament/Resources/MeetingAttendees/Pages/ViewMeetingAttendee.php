<?php

namespace App\Filament\Resources\MeetingAttendees\Pages;

use App\Filament\Resources\MeetingAttendees\MeetingAttendeeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMeetingAttendee extends ViewRecord
{
    protected static string $resource = MeetingAttendeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
