<?php

namespace App\Filament\Resources\MeetingActionItems\Pages;

use App\Filament\Resources\MeetingActionItems\MeetingActionItemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMeetingActionItem extends EditRecord
{
    protected static string $resource = MeetingActionItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
