<?php

namespace App\Filament\Resources\Interviews\Schemas;

use App\Enums\InterviewStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InterviewInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('application.applicant_name')
                    ->label('Applicant'),
                TextEntry::make('application.jobPost.title')
                    ->label('Job post')
                    ->placeholder('-'),
                TextEntry::make('scheduled_at')
                    ->dateTime(),
                TextEntry::make('interview_type'),
                TextEntry::make('status')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof InterviewStatus ? $state->value : (string) $state;

                        return InterviewStatus::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('location')
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
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
