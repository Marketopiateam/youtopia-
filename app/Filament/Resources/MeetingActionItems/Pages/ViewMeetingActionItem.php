<?php

namespace App\Filament\Resources\MeetingActionItems\Pages;

use App\Filament\Resources\MeetingActionItems\MeetingActionItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMeetingActionItem extends ViewRecord
{
    protected static string $resource = MeetingActionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
