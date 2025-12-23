<?php

namespace App\Filament\Resources\PayrollCycles\Pages;

use App\Filament\Resources\PayrollCycles\PayrollCycleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPayrollCycle extends ViewRecord
{
    protected static string $resource = PayrollCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
