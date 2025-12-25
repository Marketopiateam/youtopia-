<?php

namespace App\Filament\Resources\VoteOptions\Pages;

use App\Filament\Resources\VoteOptions\VoteOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVoteOptions extends ListRecords
{
    protected static string $resource = VoteOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
