<?php

namespace App\Filament\Resources\WorklifeAttachments;

use App\Filament\Resources\WorklifeAttachments\Pages\CreateWorklifeAttachment;
use App\Filament\Resources\WorklifeAttachments\Pages\EditWorklifeAttachment;
use App\Filament\Resources\WorklifeAttachments\Pages\ListWorklifeAttachments;
use App\Filament\Resources\WorklifeAttachments\Pages\ViewWorklifeAttachment;
use App\Filament\Resources\WorklifeAttachments\Schemas\WorklifeAttachmentForm;
use App\Filament\Resources\WorklifeAttachments\Schemas\WorklifeAttachmentInfolist;
use App\Filament\Resources\WorklifeAttachments\Tables\WorklifeAttachmentsTable;
use App\Models\WorklifeAttachment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;


class WorklifeAttachmentResource extends Resource
{
    protected static ?string $model = WorklifeAttachment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Social';

    protected static ?string $recordTitleAttribute = 'file_name';

    public static function form(Schema $schema): Schema
    {
        return WorklifeAttachmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WorklifeAttachmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorklifeAttachmentsTable::configure($table);
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
            'index' => ListWorklifeAttachments::route('/'),
            'create' => CreateWorklifeAttachment::route('/create'),
            'view' => ViewWorklifeAttachment::route('/{record}'),
            'edit' => EditWorklifeAttachment::route('/{record}/edit'),
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
