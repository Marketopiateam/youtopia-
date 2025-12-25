<?php

namespace App\Filament\Resources\AllowanceTypes;

use App\Filament\Resources\AllowanceTypes\Pages\CreateAllowanceType;
use App\Filament\Resources\AllowanceTypes\Pages\EditAllowanceType;
use App\Filament\Resources\AllowanceTypes\Pages\ListAllowanceTypes;
use App\Filament\Resources\AllowanceTypes\Pages\ViewAllowanceType;
use App\Filament\Resources\AllowanceTypes\Schemas\AllowanceTypeForm;
use App\Filament\Resources\AllowanceTypes\Schemas\AllowanceTypeInfolist;
use App\Filament\Resources\AllowanceTypes\Tables\AllowanceTypesTable;
use App\Models\AllowanceType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AllowanceTypeResource extends Resource
{
    protected static ?string $model = AllowanceType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    // protected static ?string $navigationGroup = 'Payroll';

    protected static string|UnitEnum|null $navigationGroup = 'Payroll';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AllowanceTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AllowanceTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AllowanceTypesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAllowanceTypes::route('/'),
            'create' => CreateAllowanceType::route('/create'),
            'view' => ViewAllowanceType::route('/{record}'),
            'edit' => EditAllowanceType::route('/{record}/edit'),
        ];
    }
}
