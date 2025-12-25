<?php

namespace App\Filament\Resources\PeerFeedbacks\Pages;

use App\Filament\Resources\PeerFeedbacks\PeerFeedbackResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPeerFeedback extends ViewRecord
{
    protected static string $resource = PeerFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
