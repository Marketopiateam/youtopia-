<?php

namespace App\Filament\Resources\EmployeeDocuments\Pages;

use App\Filament\Resources\EmployeeDocuments\EmployeeDocumentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployeeDocument extends ViewRecord
{
    protected static string $resource = EmployeeDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
