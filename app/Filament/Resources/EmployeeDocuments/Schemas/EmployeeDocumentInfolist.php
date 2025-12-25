<?php

namespace App\Filament\Resources\EmployeeDocuments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EmployeeDocumentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('type.name')
                    ->label('Document type')
                    ->placeholder('-'),
                TextEntry::make('file_path')
                    ->label('File'),
                TextEntry::make('issued_at')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('expires_at')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('uploader.name')
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
