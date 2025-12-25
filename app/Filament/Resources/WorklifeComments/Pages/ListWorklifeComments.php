<?php

namespace App\Filament\Resources\WorklifeComments\Pages;

use App\Filament\Resources\WorklifeComments\WorklifeCommentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorklifeComments extends ListRecords
{
    protected static string $resource = WorklifeCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
