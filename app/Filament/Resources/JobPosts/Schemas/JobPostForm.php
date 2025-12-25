<?php

namespace App\Filament\Resources\JobPosts\Schemas;

use App\Enums\JobPostStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JobPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('requirements')
                    ->columnSpanFull(),
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('created_by_employee_id')
                    ->relationship('createdBy', 'employee_code')
                    ->required()
                    ->searchable(),
                TextInput::make('url')
                    ->url()
                    ->maxLength(255),
                Select::make('status')
                    ->options(JobPostStatus::class)
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('published_at'),
                DateTimePicker::make('expires_at'),
            ]);
    }
}
