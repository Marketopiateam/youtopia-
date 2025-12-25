<?php

namespace App\Filament\Resources\ReviewQuestions;

use App\Filament\Resources\ReviewQuestions\Pages\CreateReviewQuestion;
use App\Filament\Resources\ReviewQuestions\Pages\EditReviewQuestion;
use App\Filament\Resources\ReviewQuestions\Pages\ListReviewQuestions;
use App\Filament\Resources\ReviewQuestions\Pages\ViewReviewQuestion;
use App\Filament\Resources\ReviewQuestions\RelationManagers\AnswersRelationManager;
use App\Filament\Resources\ReviewQuestions\Schemas\ReviewQuestionForm;
use App\Filament\Resources\ReviewQuestions\Schemas\ReviewQuestionInfolist;
use App\Filament\Resources\ReviewQuestions\Tables\ReviewQuestionsTable;
use App\Models\ReviewQuestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class ReviewQuestionResource extends Resource
{
    protected static ?string $model = ReviewQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Performance';

    protected static ?string $recordTitleAttribute = 'question_text';

    public static function form(Schema $schema): Schema
    {
        return ReviewQuestionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReviewQuestionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReviewQuestionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AnswersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReviewQuestions::route('/'),
            'create' => CreateReviewQuestion::route('/create'),
            'view' => ViewReviewQuestion::route('/{record}'),
            'edit' => EditReviewQuestion::route('/{record}/edit'),
        ];
    }
}
