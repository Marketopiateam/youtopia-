<?php

namespace App\Filament\Resources\DeductionTypes;

use App\Filament\Resources\DeductionTypes\Pages\CreateDeductionType;
use App\Filament\Resources\DeductionTypes\Pages\EditDeductionType;
use App\Filament\Resources\DeductionTypes\Pages\ListDeductionTypes;
use App\Filament\Resources\DeductionTypes\Pages\ViewDeductionType;
use App\Filament\Resources\DeductionTypes\Schemas\DeductionTypeForm;
use App\Filament\Resources\DeductionTypes\Schemas\DeductionTypeInfolist;
use App\Filament\Resources\DeductionTypes\Tables\DeductionTypesTable;
use App\Models\DeductionType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DeductionTypeResource extends Resource
{
    protected static ?string $model = DeductionType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static string|UnitEnum|null $navigationGroup = 'Payroll';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return DeductionTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DeductionTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DeductionTypesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDeductionTypes::route('/'),
            'create' => CreateDeductionType::route('/create'),
            'view' => ViewDeductionType::route('/{record}'),
            'edit' => EditDeductionType::route('/{record}/edit'),
        ];
    }
}
