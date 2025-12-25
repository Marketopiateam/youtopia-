<?php

namespace App\Filament\Resources\SurveyQuestionOptions;

use App\Filament\Resources\SurveyQuestionOptions\Pages\CreateSurveyQuestionOption;
use App\Filament\Resources\SurveyQuestionOptions\Pages\EditSurveyQuestionOption;
use App\Filament\Resources\SurveyQuestionOptions\Pages\ListSurveyQuestionOptions;
use App\Filament\Resources\SurveyQuestionOptions\Pages\ViewSurveyQuestionOption;
use App\Filament\Resources\SurveyQuestionOptions\Schemas\SurveyQuestionOptionForm;
use App\Filament\Resources\SurveyQuestionOptions\Schemas\SurveyQuestionOptionInfolist;
use App\Filament\Resources\SurveyQuestionOptions\Tables\SurveyQuestionOptionsTable;
use App\Models\SurveyQuestionOption;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class SurveyQuestionOptionResource extends Resource
{
    protected static ?string $model = SurveyQuestionOption::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Communication';

    protected static ?string $recordTitleAttribute = 'option_text';

    public static function form(Schema $schema): Schema
    {
        return SurveyQuestionOptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SurveyQuestionOptionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SurveyQuestionOptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveyQuestionOptions::route('/'),
            'create' => CreateSurveyQuestionOption::route('/create'),
            'view' => ViewSurveyQuestionOption::route('/{record}'),
            'edit' => EditSurveyQuestionOption::route('/{record}/edit'),
        ];
    }
}
