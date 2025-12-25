<?php

namespace App\Filament\Resources\PayslipItems\Pages;

use App\Filament\Resources\PayslipItems\PayslipItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPayslipItems extends ListRecords
{
    protected static string $resource = PayslipItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
