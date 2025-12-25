<?php

namespace App\Filament\Resources\OfferLetters\Pages;

use App\Filament\Resources\OfferLetters\OfferLetterResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOfferLetter extends EditRecord
{
    protected static string $resource = OfferLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
