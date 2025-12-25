<?php

namespace App\Filament\Resources\EmployeeDocuments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EmployeeDocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('document_type_id')
                    ->label('Document type')
                    ->relationship('type', 'name')
                    ->searchable()
                    ->required(),
                FileUpload::make('file_path')
                    ->label('File')
                    ->disk('public')
                    ->directory('employees/documents')
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable()
                    ->required(),
                DatePicker::make('issued_at'),
                DatePicker::make('expires_at'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                Select::make('uploaded_by_user_id')
                    ->label('Uploaded by')
                    ->relationship('uploader', 'name')
                    ->searchable(),
            ]);
    }
}
