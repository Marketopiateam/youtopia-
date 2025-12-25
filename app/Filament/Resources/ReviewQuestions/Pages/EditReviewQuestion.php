<?php

namespace App\Filament\Resources\ReviewQuestions\Pages;

use App\Filament\Resources\ReviewQuestions\ReviewQuestionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReviewQuestion extends EditRecord
{
    protected static string $resource = ReviewQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
