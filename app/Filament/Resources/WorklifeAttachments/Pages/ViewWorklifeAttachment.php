<?php

namespace App\Filament\Resources\WorklifeAttachments\Pages;

use App\Filament\Resources\WorklifeAttachments\WorklifeAttachmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorklifeAttachment extends ViewRecord
{
    protected static string $resource = WorklifeAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
