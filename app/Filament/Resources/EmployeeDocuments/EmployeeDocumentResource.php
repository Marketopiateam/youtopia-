<?php

namespace App\Filament\Resources\EmployeeDocuments;

use App\Filament\Resources\EmployeeDocuments\Pages\CreateEmployeeDocument;
use App\Filament\Resources\EmployeeDocuments\Pages\EditEmployeeDocument;
use App\Filament\Resources\EmployeeDocuments\Pages\ListEmployeeDocuments;
use App\Filament\Resources\EmployeeDocuments\Pages\ViewEmployeeDocument;
use App\Filament\Resources\EmployeeDocuments\Schemas\EmployeeDocumentForm;
use App\Filament\Resources\EmployeeDocuments\Schemas\EmployeeDocumentInfolist;
use App\Filament\Resources\EmployeeDocuments\Tables\EmployeeDocumentsTable;
use App\Models\EmployeeDocument;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class EmployeeDocumentResource extends Resource
{
    protected static ?string $model = EmployeeDocument::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static string|UnitEnum|null $navigationGroup = 'Onboarding';

    protected static ?string $recordTitleAttribute = 'file_path';

    public static function form(Schema $schema): Schema
    {
        return EmployeeDocumentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EmployeeDocumentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployeeDocumentsTable::configure($table);
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
            'index' => ListEmployeeDocuments::route('/'),
            'create' => CreateEmployeeDocument::route('/create'),
            'view' => ViewEmployeeDocument::route('/{record}'),
            'edit' => EditEmployeeDocument::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
