<?php

namespace App\Filament\Resources\WorklifePosts\Schemas;

use App\Enums\AudienceType;
use App\Enums\WorklifePostType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WorklifePostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('author_employee_id')
                    ->required()
                    ->numeric(),
                TextInput::make('source_type'),
                TextInput::make('source_id')
                    ->numeric(),
                Select::make('post_type')
                    ->options(WorklifePostType::class)
                    ->default('general')
                    ->required(),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Select::make('audience_type')
                    ->options(AudienceType::class)
                    ->default('company')
                    ->required(),
                TextInput::make('audience_id')
                    ->numeric(),
                Toggle::make('is_pinned')
                    ->required(),
                DateTimePicker::make('published_at'),
            ]);
    }
}
