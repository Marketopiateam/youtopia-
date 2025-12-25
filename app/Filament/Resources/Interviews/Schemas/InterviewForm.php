<?php

namespace App\Filament\Resources\Interviews\Schemas;

use App\Enums\InterviewStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InterviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('application_id')
                    ->relationship('application', 'applicant_name')
                    ->label('Application')
                    ->required()
                    ->searchable(),
                DateTimePicker::make('scheduled_at')
                    ->required(),
                TextInput::make('location')
                    ->maxLength(255),
                Select::make('interview_type')
                    ->options([
                        'in_person' => 'In person',
                        'phone' => 'Phone',
                        'video' => 'Video',
                    ])
                    ->default('in_person')
                    ->required(),
                Select::make('status')
                    ->options(InterviewStatus::class)
                    ->default('scheduled')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
