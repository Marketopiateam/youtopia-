<?php

namespace App\Filament\Resources\ApprovalSteps\Pages;

use App\Filament\Resources\ApprovalSteps\ApprovalStepResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewApprovalStep extends ViewRecord
{
    protected static string $resource = ApprovalStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
