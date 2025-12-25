<?php

namespace App\Filament\Resources\WorklifeAttachments\Pages;

use App\Filament\Resources\WorklifeAttachments\WorklifeAttachmentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWorklifeAttachment extends EditRecord
{
    protected static string $resource = WorklifeAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
