<?php

namespace App\Filament\Resources\JobPosts\Schemas;

use App\Enums\JobPostStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class JobPostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('department.name')
                    ->label('Department')
                    ->placeholder('-'),
                TextEntry::make('createdBy.employee_code')
                    ->label('Created by'),
                TextEntry::make('status')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof JobPostStatus ? $state->value : (string) $state;

                        return JobPostStatus::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('published_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('expires_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('url')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('requirements')
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
