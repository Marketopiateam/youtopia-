<?php

namespace App\Filament\Resources\SurveyQuestions;

use App\Filament\Resources\SurveyQuestions\Pages\CreateSurveyQuestion;
use App\Filament\Resources\SurveyQuestions\Pages\EditSurveyQuestion;
use App\Filament\Resources\SurveyQuestions\Pages\ListSurveyQuestions;
use App\Filament\Resources\SurveyQuestions\Pages\ViewSurveyQuestion;
use App\Filament\Resources\SurveyQuestions\RelationManagers\AnswersRelationManager;
use App\Filament\Resources\SurveyQuestions\RelationManagers\OptionsRelationManager;
use App\Filament\Resources\SurveyQuestions\Schemas\SurveyQuestionForm;
use App\Filament\Resources\SurveyQuestions\Schemas\SurveyQuestionInfolist;
use App\Filament\Resources\SurveyQuestions\Tables\SurveyQuestionsTable;
use App\Models\SurveyQuestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class SurveyQuestionResource extends Resource
{
    protected static ?string $model = SurveyQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Communication';

    protected static ?string $recordTitleAttribute = 'question_text';

    public static function form(Schema $schema): Schema
    {
        return SurveyQuestionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SurveyQuestionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SurveyQuestionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            OptionsRelationManager::class,
            AnswersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveyQuestions::route('/'),
            'create' => CreateSurveyQuestion::route('/create'),
            'view' => ViewSurveyQuestion::route('/{record}'),
            'edit' => EditSurveyQuestion::route('/{record}/edit'),
        ];
    }
}
