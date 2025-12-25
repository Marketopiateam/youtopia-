<?php

namespace App\Filament\Resources\WorklifeAttachments\Schemas;

use App\Models\WorklifeComment;
use App\Models\WorklifePost;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WorklifeAttachmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('attachable_type')
                    ->label('Attachable type')
                    ->options([
                        WorklifePost::class => 'Worklife Post',
                        WorklifeComment::class => 'Worklife Comment',
                    ])
                    ->required(),
                TextInput::make('attachable_id')
                    ->label('Attachable ID')
                    ->numeric()
                    ->required(),
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
}
