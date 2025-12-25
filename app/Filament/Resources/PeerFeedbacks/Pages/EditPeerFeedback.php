<?php

namespace App\Filament\Resources\PeerFeedbacks\Pages;

use App\Filament\Resources\PeerFeedbacks\PeerFeedbackResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPeerFeedback extends EditRecord
{
    protected static string $resource = PeerFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
