<?php

namespace App\Filament\Resources\Employees\RelationManagers;

use App\Models\DocumentType;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';
    protected static ?string $title = 'Documents';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('document_type_id')
                ->label('Document Type')
                ->options(
                    fn() => DocumentType::query()
                        ->where('is_active', true)
                        ->orderBy('name')
                        ->pluck('name', 'id')
                        ->toArray()
                )
                ->searchable()
                ->preload()
                ->required(),

            FileUpload::make('file_path')
                ->label('File')
                ->disk('public')
                ->directory('employees/documents')
                ->preserveFilenames()
                ->downloadable()
                ->openable()
                ->required(),

            DatePicker::make('issued_at')->nullable(),
            DatePicker::make('expires_at')->nullable(),

            Textarea::make('notes')->rows(3)->nullable(),

            \Filament\Forms\Components\Hidden::make('uploaded_by_user_id')
                ->default(fn() => Auth::id())
                ->dehydrated(true),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type.name')->label('Type')->sortable()->searchable(),
                TextColumn::make('file_path')->label('File')->limit(35),
                TextColumn::make('issued_at')->date(),
                TextColumn::make('expires_at')->date(),
                TextColumn::make('created_at')->since()->label('Uploaded'),
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
