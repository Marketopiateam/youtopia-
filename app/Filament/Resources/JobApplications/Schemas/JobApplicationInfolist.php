<?php

namespace App\Filament\Resources\JobApplications\Schemas;

use App\Enums\ApplicationStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class JobApplicationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('jobPost.title')
                    ->label('Job post'),
                TextEntry::make('applicant_name'),
                TextEntry::make('email'),
                TextEntry::make('phone')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ApplicationStatus ? $state->value : (string) $state;

                        return ApplicationStatus::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('applied_at')
                    ->dateTime(),
                TextEntry::make('resume_path')
                    ->label('Resume')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('cover_letter')
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
