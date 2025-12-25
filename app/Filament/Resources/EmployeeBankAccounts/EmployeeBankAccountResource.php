<?php

namespace App\Filament\Resources\EmployeeBankAccounts;

use App\Filament\Resources\EmployeeBankAccounts\Pages\CreateEmployeeBankAccount;
use App\Filament\Resources\EmployeeBankAccounts\Pages\EditEmployeeBankAccount;
use App\Filament\Resources\EmployeeBankAccounts\Pages\ListEmployeeBankAccounts;
use App\Filament\Resources\EmployeeBankAccounts\Pages\ViewEmployeeBankAccount;
use App\Filament\Resources\EmployeeBankAccounts\Schemas\EmployeeBankAccountForm;
use App\Filament\Resources\EmployeeBankAccounts\Schemas\EmployeeBankAccountInfolist;
use App\Filament\Resources\EmployeeBankAccounts\Tables\EmployeeBankAccountsTable;
use App\Models\EmployeeBankAccount;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EmployeeBankAccountResource extends Resource
{
    protected static ?string $model = EmployeeBankAccount::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static string|UnitEnum|null $navigationGroup = 'Onboarding';

    protected static ?string $recordTitleAttribute = 'account_number';

    public static function form(Schema $schema): Schema
    {
        return EmployeeBankAccountForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EmployeeBankAccountInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployeeBankAccountsTable::configure($table);
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
            'index' => ListEmployeeBankAccounts::route('/'),
            'create' => CreateEmployeeBankAccount::route('/create'),
            'view' => ViewEmployeeBankAccount::route('/{record}'),
            'edit' => EditEmployeeBankAccount::route('/{record}/edit'),
        ];
    }
}
