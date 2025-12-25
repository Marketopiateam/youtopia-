<?php

namespace App\Filament\Resources\ReviewAnswers;

use App\Filament\Resources\ReviewAnswers\Pages\CreateReviewAnswer;
use App\Filament\Resources\ReviewAnswers\Pages\EditReviewAnswer;
use App\Filament\Resources\ReviewAnswers\Pages\ListReviewAnswers;
use App\Filament\Resources\ReviewAnswers\Pages\ViewReviewAnswer;
use App\Filament\Resources\ReviewAnswers\Schemas\ReviewAnswerForm;
use App\Filament\Resources\ReviewAnswers\Schemas\ReviewAnswerInfolist;
use App\Filament\Resources\ReviewAnswers\Tables\ReviewAnswersTable;
use App\Models\ReviewAnswer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class ReviewAnswerResource extends Resource
{
    protected static ?string $model = ReviewAnswer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Performance';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return ReviewAnswerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReviewAnswerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReviewAnswersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReviewAnswers::route('/'),
            'create' => CreateReviewAnswer::route('/create'),
            'view' => ViewReviewAnswer::route('/{record}'),
            'edit' => EditReviewAnswer::route('/{record}/edit'),
        ];
    }
}
