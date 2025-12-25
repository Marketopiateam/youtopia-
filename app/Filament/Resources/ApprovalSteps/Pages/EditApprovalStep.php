<?php

namespace App\Filament\Resources\ApprovalSteps\Pages;

use App\Filament\Resources\ApprovalSteps\ApprovalStepResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditApprovalStep extends EditRecord
{
    protected static string $resource = ApprovalStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
