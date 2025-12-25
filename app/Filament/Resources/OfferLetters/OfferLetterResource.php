<?php

namespace App\Filament\Resources\OfferLetters;

use App\Filament\Resources\OfferLetters\Pages\CreateOfferLetter;
use App\Filament\Resources\OfferLetters\Pages\EditOfferLetter;
use App\Filament\Resources\OfferLetters\Pages\ListOfferLetters;
use App\Filament\Resources\OfferLetters\Pages\ViewOfferLetter;
use App\Filament\Resources\OfferLetters\Schemas\OfferLetterForm;
use App\Filament\Resources\OfferLetters\Schemas\OfferLetterInfolist;
use App\Filament\Resources\OfferLetters\Tables\OfferLettersTable;
use App\Models\OfferLetter;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;


class OfferLetterResource extends Resource
{
    protected static ?string $model = OfferLetter::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static string|UnitEnum|null $navigationGroup = 'Recruitment';

    protected static ?string $recordTitleAttribute = 'offered_position';

    public static function form(Schema $schema): Schema
    {
        return OfferLetterForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OfferLetterInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OfferLettersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOfferLetters::route('/'),
            'create' => CreateOfferLetter::route('/create'),
            'view' => ViewOfferLetter::route('/{record}'),
            'edit' => EditOfferLetter::route('/{record}/edit'),
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
