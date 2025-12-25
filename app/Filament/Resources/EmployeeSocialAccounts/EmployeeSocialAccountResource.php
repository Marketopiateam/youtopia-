<?php

namespace App\Filament\Resources\EmployeeSocialAccounts;

use App\Filament\Resources\EmployeeSocialAccounts\Pages\CreateEmployeeSocialAccount;
use App\Filament\Resources\EmployeeSocialAccounts\Pages\EditEmployeeSocialAccount;
use App\Filament\Resources\EmployeeSocialAccounts\Pages\ListEmployeeSocialAccounts;
use App\Filament\Resources\EmployeeSocialAccounts\Pages\ViewEmployeeSocialAccount;
use App\Filament\Resources\EmployeeSocialAccounts\Schemas\EmployeeSocialAccountForm;
use App\Filament\Resources\EmployeeSocialAccounts\Schemas\EmployeeSocialAccountInfolist;
use App\Filament\Resources\EmployeeSocialAccounts\Tables\EmployeeSocialAccountsTable;
use App\Models\EmployeeSocialAccount;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EmployeeSocialAccountResource extends Resource
{
    protected static ?string $model = EmployeeSocialAccount::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Onboarding';

    protected static ?string $recordTitleAttribute = 'platform';

    public static function form(Schema $schema): Schema
    {
        return EmployeeSocialAccountForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EmployeeSocialAccountInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployeeSocialAccountsTable::configure($table);
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
            'index' => ListEmployeeSocialAccounts::route('/'),
            'create' => CreateEmployeeSocialAccount::route('/create'),
            'view' => ViewEmployeeSocialAccount::route('/{record}'),
            'edit' => EditEmployeeSocialAccount::route('/{record}/edit'),
        ];
    }
}
