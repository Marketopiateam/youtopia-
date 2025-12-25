<?php

namespace App\Filament\Resources\ReviewQuestions\Pages;

use App\Filament\Resources\ReviewQuestions\ReviewQuestionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReviewQuestions extends ListRecords
{
    protected static string $resource = ReviewQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
