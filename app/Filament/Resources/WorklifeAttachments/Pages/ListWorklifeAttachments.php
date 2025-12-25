<?php

namespace App\Filament\Resources\WorklifeAttachments\Pages;

use App\Filament\Resources\WorklifeAttachments\WorklifeAttachmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorklifeAttachments extends ListRecords
{
    protected static string $resource = WorklifeAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
