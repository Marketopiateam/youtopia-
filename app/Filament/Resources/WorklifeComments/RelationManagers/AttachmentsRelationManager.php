<?php

namespace App\Filament\Resources\WorklifeComments\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';

    protected static ?string $title = 'Attachments';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('file_path')
                    ->label('File')
                    ->disk('public')
                    ->directory('worklife/attachments')
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable()
                    ->required(),
                TextInput::make('file_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('mime_type')
                    ->maxLength(255),
                TextInput::make('file_size')
                    ->numeric()
                    ->required(),
                Select::make('uploaded_by_employee_id')
                    ->label('Uploaded by')
                    ->relationship('uploader', 'employee_code')
                    ->searchable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('file_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('mime_type')
                    ->placeholder('-'),
                TextColumn::make('file_size')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('uploader.employee_code')
                    ->label('Uploaded by')
                    ->searchable()
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
