<?php

namespace App\Filament\Resources\PerformanceReviewTemplates;

use App\Filament\Resources\PerformanceReviewTemplates\Pages\CreatePerformanceReviewTemplate;
use App\Filament\Resources\PerformanceReviewTemplates\Pages\EditPerformanceReviewTemplate;
use App\Filament\Resources\PerformanceReviewTemplates\Pages\ListPerformanceReviewTemplates;
use App\Filament\Resources\PerformanceReviewTemplates\Pages\ViewPerformanceReviewTemplate;
use App\Filament\Resources\PerformanceReviewTemplates\RelationManagers\QuestionsRelationManager;
use App\Filament\Resources\PerformanceReviewTemplates\RelationManagers\ReviewsRelationManager;
use App\Filament\Resources\PerformanceReviewTemplates\Schemas\PerformanceReviewTemplateForm;
use App\Filament\Resources\PerformanceReviewTemplates\Schemas\PerformanceReviewTemplateInfolist;
use App\Filament\Resources\PerformanceReviewTemplates\Tables\PerformanceReviewTemplatesTable;
use App\Models\PerformanceReviewTemplate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class PerformanceReviewTemplateResource extends Resource
{
    protected static ?string $model = PerformanceReviewTemplate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Performance';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PerformanceReviewTemplateForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PerformanceReviewTemplateInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PerformanceReviewTemplatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            QuestionsRelationManager::class,
            ReviewsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPerformanceReviewTemplates::route('/'),
            'create' => CreatePerformanceReviewTemplate::route('/create'),
            'view' => ViewPerformanceReviewTemplate::route('/{record}'),
            'edit' => EditPerformanceReviewTemplate::route('/{record}/edit'),
        ];
    }
}
