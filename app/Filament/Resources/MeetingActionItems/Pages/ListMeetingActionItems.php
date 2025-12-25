<?php

namespace App\Filament\Resources\MeetingActionItems\Pages;

use App\Filament\Resources\MeetingActionItems\MeetingActionItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMeetingActionItems extends ListRecords
{
    protected static string $resource = MeetingActionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
