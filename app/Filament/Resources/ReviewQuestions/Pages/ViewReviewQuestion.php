<?php

namespace App\Filament\Resources\ReviewQuestions\Pages;

use App\Filament\Resources\ReviewQuestions\ReviewQuestionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReviewQuestion extends ViewRecord
{
    protected static string $resource = ReviewQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
