<?php

namespace App\Filament\Resources\PayslipItems;

use App\Filament\Resources\PayslipItems\Pages\CreatePayslipItem;
use App\Filament\Resources\PayslipItems\Pages\EditPayslipItem;
use App\Filament\Resources\PayslipItems\Pages\ListPayslipItems;
use App\Filament\Resources\PayslipItems\Pages\ViewPayslipItem;
use App\Filament\Resources\PayslipItems\Schemas\PayslipItemForm;
use App\Filament\Resources\PayslipItems\Schemas\PayslipItemInfolist;
use App\Filament\Resources\PayslipItems\Tables\PayslipItemsTable;
use App\Models\PayslipItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class PayslipItemResource extends Resource
{
    protected static ?string $model = PayslipItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;


    protected static string|UnitEnum|null $navigationGroup = 'Payroll';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return PayslipItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PayslipItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PayslipItemsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPayslipItems::route('/'),
            'create' => CreatePayslipItem::route('/create'),
            'view' => ViewPayslipItem::route('/{record}'),
            'edit' => EditPayslipItem::route('/{record}/edit'),
        ];
    }
}
