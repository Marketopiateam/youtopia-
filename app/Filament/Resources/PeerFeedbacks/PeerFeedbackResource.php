<?php

namespace App\Filament\Resources\PeerFeedbacks;

use App\Filament\Resources\PeerFeedbacks\Pages\CreatePeerFeedback;
use App\Filament\Resources\PeerFeedbacks\Pages\EditPeerFeedback;
use App\Filament\Resources\PeerFeedbacks\Pages\ListPeerFeedbacks;
use App\Filament\Resources\PeerFeedbacks\Pages\ViewPeerFeedback;
use App\Filament\Resources\PeerFeedbacks\Schemas\PeerFeedbackForm;
use App\Filament\Resources\PeerFeedbacks\Schemas\PeerFeedbackInfolist;
use App\Filament\Resources\PeerFeedbacks\Tables\PeerFeedbacksTable;
use App\Models\PeerFeedback;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class PeerFeedbackResource extends Resource
{
    protected static ?string $model = PeerFeedback::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Performance';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return PeerFeedbackForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PeerFeedbackInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PeerFeedbacksTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPeerFeedbacks::route('/'),
            'create' => CreatePeerFeedback::route('/create'),
            'view' => ViewPeerFeedback::route('/{record}'),
            'edit' => EditPeerFeedback::route('/{record}/edit'),
        ];
    }
}
