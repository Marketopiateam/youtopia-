<?php

namespace App\Filament\Resources\PayslipItems\Pages;

use App\Filament\Resources\PayslipItems\PayslipItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPayslipItem extends EditRecord
{
    protected static string $resource = PayslipItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
