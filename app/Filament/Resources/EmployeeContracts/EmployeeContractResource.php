<?php

namespace App\Filament\Resources\EmployeeContracts;

use App\Filament\Resources\EmployeeContracts\Pages\CreateEmployeeContract;
use App\Filament\Resources\EmployeeContracts\Pages\EditEmployeeContract;
use App\Filament\Resources\EmployeeContracts\Pages\ListEmployeeContracts;
use App\Filament\Resources\EmployeeContracts\Pages\ViewEmployeeContract;
use App\Filament\Resources\EmployeeContracts\Schemas\EmployeeContractForm;
use App\Filament\Resources\EmployeeContracts\Schemas\EmployeeContractInfolist;
use App\Filament\Resources\EmployeeContracts\Tables\EmployeeContractsTable;
use App\Models\EmployeeContract;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EmployeeContractResource extends Resource
{
    protected static ?string $model = EmployeeContract::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Onboarding';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return EmployeeContractForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EmployeeContractInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployeeContractsTable::configure($table);
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
            'index' => ListEmployeeContracts::route('/'),
            'create' => CreateEmployeeContract::route('/create'),
            'view' => ViewEmployeeContract::route('/{record}'),
            'edit' => EditEmployeeContract::route('/{record}/edit'),
        ];
    }
}
