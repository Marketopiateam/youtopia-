<?php

namespace App\Filament\Resources\PeerFeedbacks\Pages;

use App\Filament\Resources\PeerFeedbacks\PeerFeedbackResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPeerFeedbacks extends ListRecords
{
    protected static string $resource = PeerFeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
