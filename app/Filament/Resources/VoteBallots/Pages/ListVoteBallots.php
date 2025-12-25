<?php

namespace App\Filament\Resources\VoteBallots\Pages;

use App\Filament\Resources\VoteBallots\VoteBallotResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVoteBallots extends ListRecords
{
    protected static string $resource = VoteBallotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
