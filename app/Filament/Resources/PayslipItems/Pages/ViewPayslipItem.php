<?php

namespace App\Filament\Resources\PayslipItems\Pages;

use App\Filament\Resources\PayslipItems\PayslipItemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPayslipItem extends ViewRecord
{
    protected static string $resource = PayslipItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
