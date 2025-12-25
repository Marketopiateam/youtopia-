<?php

namespace App\Filament\Resources\WorklifeAttachments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WorklifeAttachmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('attachable_type')
                    ->label('Attachable type'),
                TextEntry::make('attachable_id')
                    ->label('Attachable ID'),
                TextEntry::make('file_name'),
                TextEntry::make('file_path')
                    ->label('File'),
                TextEntry::make('mime_type')
                    ->placeholder('-'),
                TextEntry::make('file_size'),
                TextEntry::make('uploader.employee_code')
                    ->label('Uploaded by')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
