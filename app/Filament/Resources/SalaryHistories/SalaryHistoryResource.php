<?php

namespace App\Filament\Resources\SalaryHistories;

use App\Filament\Resources\SalaryHistories\Pages\CreateSalaryHistory;
use App\Filament\Resources\SalaryHistories\Pages\EditSalaryHistory;
use App\Filament\Resources\SalaryHistories\Pages\ListSalaryHistories;
use App\Filament\Resources\SalaryHistories\Pages\ViewSalaryHistory;
use App\Filament\Resources\SalaryHistories\Schemas\SalaryHistoryForm;
use App\Filament\Resources\SalaryHistories\Schemas\SalaryHistoryInfolist;
use App\Filament\Resources\SalaryHistories\Tables\SalaryHistoriesTable;
use App\Models\SalaryHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class SalaryHistoryResource extends Resource
{
    protected static ?string $model = SalaryHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;


    protected static string|UnitEnum|null $navigationGroup = 'Payroll';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return SalaryHistoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SalaryHistoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalaryHistoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSalaryHistories::route('/'),
            'create' => CreateSalaryHistory::route('/create'),
            'view' => ViewSalaryHistory::route('/{record}'),
            'edit' => EditSalaryHistory::route('/{record}/edit'),
        ];
    }
}
