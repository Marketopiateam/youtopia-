<?php

namespace App\Filament\Resources\ReviewAnswers\Pages;

use App\Filament\Resources\ReviewAnswers\ReviewAnswerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReviewAnswers extends ListRecords
{
    protected static string $resource = ReviewAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
