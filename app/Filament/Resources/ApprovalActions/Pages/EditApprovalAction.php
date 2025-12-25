<?php

namespace App\Filament\Resources\ApprovalActions\Pages;

use App\Filament\Resources\ApprovalActions\ApprovalActionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditApprovalAction extends EditRecord
{
    protected static string $resource = ApprovalActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
