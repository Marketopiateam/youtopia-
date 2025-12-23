<?php

namespace App\Filament\Resources\PerformanceReviews\Schemas;

use App\Enums\ReviewStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PerformanceReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('template_id')
                    ->relationship('template', 'name')
                    ->required(),
                Select::make('employee_id')
                    ->relationship('employee', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('reviewer_employee_id')
                    ->relationship('reviewer', 'employee_code')
                    ->searchable()
                    ->required(),
                DatePicker::make('review_period_start')
                    ->required(),
                DatePicker::make('review_period_end')
                    ->required(),
                TextInput::make('overall_rating')
                    ->numeric(),
                Textarea::make('summary')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(ReviewStatus::class)
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('submitted_at'),
            ]);
    }
}
