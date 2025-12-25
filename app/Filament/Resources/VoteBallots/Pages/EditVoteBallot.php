<?php

namespace App\Filament\Resources\VoteBallots\Pages;

use App\Filament\Resources\VoteBallots\VoteBallotResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditVoteBallot extends EditRecord
{
    protected static string $resource = VoteBallotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
