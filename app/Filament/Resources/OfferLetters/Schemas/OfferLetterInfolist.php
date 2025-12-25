<?php

namespace App\Filament\Resources\OfferLetters\Schemas;

use App\Enums\OfferStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OfferLetterInfolist
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
                TextEntry::make('offered_position'),
                TextEntry::make('salary_amount')
                    ->numeric(),
                TextEntry::make('currency_code'),
                TextEntry::make('start_date')
                    ->date(),
                TextEntry::make('status')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof OfferStatus ? $state->value : (string) $state;

                        return OfferStatus::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('sent_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('accepted_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('terms')
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
