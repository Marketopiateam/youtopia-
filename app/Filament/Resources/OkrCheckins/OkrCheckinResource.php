<?php

namespace App\Filament\Resources\OkrCheckins;

use App\Filament\Resources\OkrCheckins\Pages\CreateOkrCheckin;
use App\Filament\Resources\OkrCheckins\Pages\EditOkrCheckin;
use App\Filament\Resources\OkrCheckins\Pages\ListOkrCheckins;
use App\Filament\Resources\OkrCheckins\Pages\ViewOkrCheckin;
use App\Filament\Resources\OkrCheckins\Schemas\OkrCheckinForm;
use App\Filament\Resources\OkrCheckins\Schemas\OkrCheckinInfolist;
use App\Filament\Resources\OkrCheckins\Tables\OkrCheckinsTable;
use App\Models\OkrCheckin;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class OkrCheckinResource extends Resource
{
    protected static ?string $model = OkrCheckin::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Strategy';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return OkrCheckinForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OkrCheckinInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OkrCheckinsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOkrCheckins::route('/'),
            'create' => CreateOkrCheckin::route('/create'),
            'view' => ViewOkrCheckin::route('/{record}'),
            'edit' => EditOkrCheckin::route('/{record}/edit'),
        ];
    }
}
