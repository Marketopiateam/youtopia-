<?php

namespace App\Filament\Resources\ConversationParticipants\Pages;

use App\Filament\Resources\ConversationParticipants\ConversationParticipantResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewConversationParticipant extends ViewRecord
{
    protected static string $resource = ConversationParticipantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
