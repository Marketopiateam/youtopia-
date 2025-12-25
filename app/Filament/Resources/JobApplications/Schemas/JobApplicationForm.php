<?php

namespace App\Filament\Resources\JobApplications\Schemas;

use App\Enums\ApplicationStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JobApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('job_post_id')
                    ->relationship('jobPost', 'title')
                    ->label('Job post')
                    ->required()
                    ->searchable(),
                TextInput::make('applicant_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                FileUpload::make('resume_path')
                    ->disk('public')
                    ->directory('recruitment/resumes')
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable(),
                Textarea::make('cover_letter')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(ApplicationStatus::class)
                    ->default('applied')
                    ->required(),
                DateTimePicker::make('applied_at')
                    ->required(),
            ]);
    }
}
