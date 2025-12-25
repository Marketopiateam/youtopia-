<?php

namespace App\Filament\Resources\ReviewAnswers\Pages;

use App\Filament\Resources\ReviewAnswers\ReviewAnswerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReviewAnswer extends EditRecord
{
    protected static string $resource = ReviewAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
